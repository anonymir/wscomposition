
<div class="panel" style="padding:10px; margin-bottom:10px;">
	<form id="decouverte-executer-form">
		<div class="input-group" style="direction:ltr; margin-bottom:3px; width:100%;">
			<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Corpus d'expérimentation</span>
			<input class="form-control" type="file" name="corpus" />
		</div>
		<div class="input-group" style="direction:ltr; margin-bottom:3px; width:100%;">
			<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Algorithme de découverte</span>
			<input class="form-control" type="text" name="algorithme" value="http://localhost:51002/Services/ServiceDecouverte.asmx?WSDL" />
		</div>
		<div class="input-group" style="direction:ltr; margin-bottom:3px; width:100%;">
			<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Concepts d'entrée</span>
			<input class="form-control" type="text" name="inputs" value="C1 C2 C5 C5 C6 C7 C8 C9 C10" />
		</div>
		<div class="input-group" style="direction:ltr; margin-bottom:3px; width:100%;">
			<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Concepts de sortie</span>
			<input class="form-control" type="text" name="outputs" value="C3" />
		</div>
	</form>
	<input id="decouverte-executer" type="button" style="margin-top:3px;" class="btn btn-block social-tumblr" value="Exécuter l'algorithme de découverte" />
</div>

<div class="row" style="margin:0 -10px;">
	<div class="col-lg-12">
		<div class="panel" style="padding:10px; margin-bottom:10px;">
			<pre data-plugin="highlight" style="height:348px; overflow-y:auto; overflow-x:hidden; margin-bottom:3px;"><code id="decouverte-results" class="json"></code></pre>

			<input id="decouverte-results-download" type="button" disabled class="btn btn-block social-tumblr" value="Enregistrer le résultat retourné par l'algorithme de découverte" />
		</div>
	</div>
</div>

<script>
	$("#decouverte-results-download" ).click(function() {
		download($("#decouverte-results").text(), "decouverte-results.json", "text/json");
	});
	
	$("#decouverte-executer").click(function() {
		$("#decouverte-results").text("");
		
		var form = new FormData(document.querySelector('#decouverte-executer-form'));
		var xhr = new XMLHttpRequest();
		
		xhr.open("POST", "http://localhost/PFE/app/services/client_decouverte.php");
		xhr.addEventListener('load', function() {
			var x2js = new X2JS();
			var data = $.parseJSON(this.responseText);
			
			$("#decouverte-results").text(vkbeautify.json(JSON.stringify(data), 2));

			$('pre code').each(function(i, block) {
				hljs.highlightBlock(block);
			});
			
			$("#decouverte-results-download").prop('disabled', false);
		});
		xhr.send(form);
	});
</script>