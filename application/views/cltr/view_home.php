            <style>
            video {
              max-width: 100%;
              height: auto;
            }
            
            .open-button {
              background-color: transparent;
              color: #009933;
              padding: 16px 20px;
              border: none;
              cursor: pointer;
              opacity: 0.8;
              position: fixed;
              bottom: 23px;
              right: 8px;
              width: 80px;
              z-index: 900;
            }
            </style>
            
            <div id="modal" class="modal fade" tabindex="-1" role="dialog">
        	  <div class="modal-dialog modal-lg" role="document">
        	    <div class="modal-content">
        	      <div class="modal-header">
        	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	      </div>
        	      <div class="modal-body">
    	      		<div style="text-align:center">
    	      		<img style="width:550px" src="https://new.gorontalo.litbang.pertanian.go.id/web/asset/foto_banner_cltr/maklumat_pelayanan_5.jpg">
    	      		</div>
    	      		<div style="margin-top:10px;text-align:center">
    	      		<a href="https://www.pertanian.go.id/wbs/" target="_blank"><img style="width:550px" src="https://new.gorontalo.litbang.pertanian.go.id/web/asset/foto_banner_cltr/zi_fr.jpg"></a>
    	      		</div>
    	      		<div style="margin-top:10px;text-align:center">
    	      		<a href="https://bptpgorontalo-ppid.pertanian.go.id" target="_blank"><img src="https://new.gorontalo.litbang.pertanian.go.id/web/asset/foto_banner_cltr/ppid3.jpg"></a>
    	      		</div>
    	      		<!--
    	      		<figure class="highcharts-figure">
                      <div id="container-speed" class="chart-container"></div>
                      <div id="container-rpm" class="chart-container"></div>
                    </figure>
                    -->
        	      </div>
        	      <div class="modal-footer">
        	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        	      </div>
        	    </div><!-- /.modal-content -->
        	  </div><!-- /.modal-dialog -->
        	</div><!-- /.modal -->
            
            <?php 
            $this->template->hero_area(2);
            $this->template->feature_area();
            $this->template->blog_area(3);
            $this->template->navtabs_area();
            $this->template->pranala_area();
            $this->template->upcoming_area(4);
            $this->template->infografis_area(5);
            $this->template->kontak_area();
            ?>
            <a target="_blank" href="https://api.whatsapp.com/send?phone=6281282410448&text=*Layanan-BPTP Gorontalo*"><button class="open-button">Live Chat <i style="color:#009933;font-size:50px" class="fa fa-whatsapp"></i></button></a>
            
             
             
        	
   