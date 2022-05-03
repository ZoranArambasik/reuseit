<div class="container-fluid topmenu2 p-0">
     <div class="black-box">
      <div class="container">
          <div class="green-top-message-check-price">


            <div class="icons-text-front">
              <div class="row align-items-center icons_and_text">
              <div class="icons_each">
              <div id="icons-with-1" class="icons-with-text">
              <div class="icon-image"><img src="/wp-content/themes/reuseit-new/images/fri-frakt.png" alt="Alltid fri frakt" title="Alltid fri frakt"></div>
              <div class="next-to-icon">Fri frakt över 3000kr</div></div>
              </div>
              </div>
              </div>
              <div class="icons-text-front">
              <div class="row align-items-center icons_and_text">
              <div class="icons_each">
              <div id="icons-with-1" class="icons-with-text">
              <div class="icon-image"><img src="/wp-content/themes/reuseit-new/images/fri-retur.png" alt="14 dagars fri returrätt" title="14 dagars fri returrätt"></div>
              <div class="next-to-icon">14 dagars fri returrätt</div></div>
              </div>
              </div>
              </div>
              <div class="icons-text-front">
              <div class="row align-items-center icons_and_text">
              <div class="icons_each">
              <div id="icons-with-1" class="icons-with-text">
              <div class="icon-image"><img src="/wp-content/themes/reuseit-new/images/hallbart-val.png" alt="Ett hållbart val!" title="Ett hållbart val!"></div>
              <div class="next-to-icon">Ett hållbart val!</div></div>
              </div>
              </div>
              </div>
              <div class="icons-text-front">
              <div class="row align-items-center icons_and_text">
              <div class="icons_each">
              <div id="icons-with-1" class="icons-with-text">
              <div class="icon-image"><img src="/wp-content/themes/reuseit-new/images/garanti.png" alt="Ett hållbart val!" title="Ett hållbart val!"></div>
              <div class="next-to-icon">Minst 12 månaders garanti</div></div>
              </div>
              </div>
            </div>

              <div class="top-price-check">
                  <?php
                      $company = WC()->session->get( 'my_custom_tax_rate_company' );
                      if($company == 1){
                          $c_checked = 'checked="checked"';
                          $checked = '';
                      } else {
                          $checked = 'checked="checked"';
                          $c_checked = '';
                      }
                      ?>

                  <label class="topmenu-label topmenu-label-first">Privatperson
                  <input <?php echo $checked; ?> name="tax_toggle" value="private" id="private" type="radio" />
                  <!-- <span class="checkmark"></span> -->
                  </label>
                  <label class="topmenu-label topmenu-label-second">Företag
                  <input <?php echo $c_checked; ?> name="tax_toggle" type="radio" value="company" id="company" />
                  <!-- <span class="checkmark"></span> -->
                  </label>

              </div>
          </div>
        </div>
    </div>
    <div class="header-c pl-3 pr-3">
      <div class="top-logo col-12 col-md-4 col-lg-3 p-0">
          <a href="<?php echo esc_url( home_url( '/' )); ?>">
            <img class="" src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="logo" />
          </a>
      </div>
      <a href="<?php echo esc_url( home_url( '/' )); ?>">Fortsätt handla <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
      </div>
    </div>
</div>
