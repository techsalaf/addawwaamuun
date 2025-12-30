<?php
/**
 * GitHub webhook deployment script
 *
 * Place this file at: /deploy/git-deploy.php
 * And configure a GitHub webhook:
 *   - Payload URL: https://elearning.addawwamuun.com/deploy/git-deploy.php
 *   - Content type: application/json
 *   - Secret: (set a strong secret and also set it below)
 *   - Trigger: Just the push event
 */

// 1. BASIC CONFIGURATION ----------------------------------------------------

// Shared secret: set the SAME value in the GitHub webhook settings.
// IMPORTANT: change this to a strong random string on your server.
$secret = '2026AddawwaamuunLearningManagementSystem';

// Absolute path to the git repository on the Namecheap server.
// Example (adjust to your real path, e.g. /home/username/elearning.addawwamuun.com):
$repoDir = dirname(__DIR__); // one level above /deploy, i.e. project root

// Branch to deploy
$branch = 'main';

// Path to git binary (update if git lives elsewhere on your server)
$gitBinary = '/usr/bin/git';

// Log file (make sure the web server user can write here)
$logFile = __DIR__ . '/deploy.log';

// 2. HELPER: SIMPLE LOGGER ---------------------------------------------------

function log_message($message)
{
    global $logFile;
    $date = date('Y-m-d H:i:s');
    $line = "[$date] $message" . PHP_EOL;
    // Suppress errors to avoid breaking webhook responses
    @file_put_contents($logFile, $line, FILE_APPEND | LOCK_EX);
}

// 3. READ RAW PAYLOAD & HEADERS --------------------------------------------

$payload = file_get_contents('php://input');
$signatureHeader = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';
$event = $_SERVER['HTTP_X_GITHUB_EVENT'] ?? '';
$delivery = $_SERVER['HTTP_X_GITHUB_DELIVERY'] ?? '';

log_message("Incoming request: event=$event delivery=$delivery");

// 4. VERIFY SIGNATURE (HMAC SHA256) ----------------------------------------

if (empty($secret)) {
    http_response_code(500);
    echo 'Deployment misconfigured: secret not set';
    log_message('ERROR: Secret is empty; refusing to deploy');
    exit;
}

if (!$signatureHeader) {
    http_response_code(400);
    echo 'Missing X-Hub-Signature-256 header';
    log_message('ERROR: Missing X-Hub-Signature-256 header');
    exit;
}

$expected = 'sha256=' . hash_hmac('sha256', $payload, $secret);

// Timing-safe comparison
if (!hash_equals($expected, $signatureHeader)) {
    http_response_code(403);
    echo 'Invalid signature';
    log_message('ERROR: Invalid signature');
    exit;
}

// 5. DECODE JSON & CHECK EVENT / BRANCH ------------------------------------

$data = json_decode($payload, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo 'Invalid JSON';
    log_message('ERROR: Invalid JSON payload');
    exit;
}

if ($event !== 'push') {
    http_response_code(200);
    echo 'Ignored: not a push event';
    log_message("INFO: Ignored event '$event'");
    exit;
}

$ref = $data['ref'] ?? '';
if ($ref !== 'refs/heads/' . $branch) {
    http_response_code(200);
    echo 'Ignored: not target branch';
    log_message("INFO: Ignored push to ref '$ref' (target is 'refs/heads/$branch')");
    exit;
}

// 6. RUN git PULL -----------------------------------------------------------

if (!is_dir($repoDir)) {
    http_response_code(500);
    echo 'Repository directory not found';
    log_message("ERROR: Repository directory not found: $repoDir");
    exit;
}

chdir($repoDir);

$commands = [
    'pwd',
    // Ensure we are on the correct branch and up to date
    sprintf('%s fetch origin %s 2>&1', escapeshellcmd($gitBinary), escapeshellarg($branch)),
    sprintf('%s checkout %s 2>&1', escapeshellcmd($gitBinary), escapeshellarg($branch)),
    sprintf('%s pull origin %s 2>&1', escapeshellcmd($gitBinary), escapeshellarg($branch)),
];

$outputAll = [];
$exitCode = 0;

foreach ($commands as $cmd) {
    $output = [];
    $code = 0;
    exec($cmd, $output, $code);
    $outputAll[] = '$ ' . $cmd;
    $outputAll = array_merge($outputAll, $output);

    if ($code !== 0) {
        $exitCode = $code;
        log_message("ERROR: Command failed with code $code: $cmd");
        break;
    }
}

log_message("Deployment output:\n" . implode("\n", $outputAll));

if ($exitCode === 0) {
    http_response_code(200);
    echo 'OK';
    log_message('SUCCESS: Deployment completed successfully');
} else {
    http_response_code(500);
    echo 'Deployment failed';
    log_message('ERROR: Deployment failed');
}
