  <!-- JS Plugins Init. -->
  <script>
  	function tour() {
  		introJs().setOptions({
  			disableInteraction: true,
  			steps: [{
  				intro: "Welcome, we will briefly explain our feature`s"
  			}]
  		}).start();
  	}

  	$(document).ready(function () {
  		$('table.table').each(function () {
  			$($(this).attr('id')).DataTable({
  				responsive: true
  			});
  		});

  		//  ckeditor
  		$('textarea.editor').each(function () {
  			CKEDITOR.replace($(this).attr('id'));
  		});
  	})

  </script>

  </body>

  </html>

  </body>

  </html>
