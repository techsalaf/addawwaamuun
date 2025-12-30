<footer class="footer py-4">
  <div class="container-fluid">
    <div class="d-block mx-auto">
      {!! !is_null($footerTextInfo) && isset($footerTextInfo->copyright_text) ? $footerTextInfo->copyright_text : '© ' . date('Y') . ' All Rights Reserved' !!}
    </div>
  </div>
</footer>
