        </div>
    </main>
    <footer class="mt-4 bg-dark text-white text-center shadow text-lg-start">
      <div class="container p-4">
        <div class="row">
          <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
            <h5><?= PAGE_TITLE?></h5>
            <p>
                <?= DESCRIPTION?>
            </p>
          </div>
          <div class="col-lg-6 col-md-12 mb-4 mb-md-0 d-flex justify-content-end">
            <div>
                <h5 class="text-uppercase mb-0">Links</h5>
                <ul class="list-unstyled">
                <li>
                    <a href="<?= Linker::link('index', 'imprint')?>" class="underline text-white">Impressum</a>
                </li>
                <li>
                    <a href="<?= Linker::link('index', 'imprint')?>" class="underline text-white">Datenschutz</a>
                </li>
                <li>
                    <a href="<?= Linker::link('auth', 'login')?>" class="underline text-white">Login</a>
                </li>
                </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2021 Copyright:
        <a class="text-white" href="https://hatbe.ch/">HATBE.CH</a>
      </div>
    </footer>
    </body>
</html>