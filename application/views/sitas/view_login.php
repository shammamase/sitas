<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Log-In</title>
    <link href="<?= base_url() ?>asset/favicon.png" rel="icon">
    <link href="<?= base_url() ?>asset/lte31/plugins/bootstrap/css_2020/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>asset/lte31/plugins/bootstrap/css_2020/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>asset/lte31/plugins/bootstrap/css_2020/style.css" rel="stylesheet">
  </head>
  <body style="background-color:#D8857D">
    <section style="background:url(<?= base_url() ?>asset/gambar/bsip_tas.jpg);background-size:cover;background-repeat:no-repeat;background-position:center;position:relative;z-index:2;overflow:hidden;">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="_lk_de">
              <form method="post" action="">
              <div class="form-03-main">
                <div style="text-align:center">
                  <img src="<?= base_url() ?>asset/gambar/bsip_tas_ic.png">
                </div>
                <div class="form-group">
                  <input type="text" name="a" class="form-control _ge_de_ol" type="text" placeholder="Username" required="" aria-required="true">
                </div>

                <div class="form-group">
                  <input type="password" name="b" class="form-control _ge_de_ol" type="text" placeholder="Password" required="" aria-required="true">
                </div>
                <input type="hidden" name="c" value="2024">
                <input type="hidden" name="d" value="<?= $redir ?>">
                <div class="form-group">
                    <button style="background-color:#D8857D" type="submit" name="submit" class="btn btn-outline-danger btn-block text-white"><b>Login</b></button>
                </div>

                <div class="form-group nm_lk">&nbsp;</div>

                <div class="form-group pt-0">
                  <div class="_social_04">
                    <ol>
                      &nbsp;
                    </ol>
                  </div>
                </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>