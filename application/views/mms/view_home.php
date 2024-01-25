            <style>
            video {
              max-width: 100%;
              height: auto;
            }
            </style>
            
            <div id="modal" class="modal fade" tabindex="-1" role="dialog">
        	  <div class="modal-dialog modal-lg" role="document">
        	    <div class="modal-content">
        	      <div class="modal-header">
        	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	      </div>
        	      <div class="modal-body">
    	      		<img src="http://new.gorontalo.litbang.pertanian.go.id/web/asset/foto_banner_cltr/maklumat_pelayanan.jpg">
    	      		
    	      		<figure class="highcharts-figure">
                      <div id="container-speed" class="chart-container"></div>
                      <div id="container-rpm" class="chart-container"></div>
                    </figure>
                    
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
             
             
        	
   