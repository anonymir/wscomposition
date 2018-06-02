
<div class="panel" style="padding:10px; margin-bottom:10px;">
	<form id="orchestration-generer-form">
		<div class="row">
			<div class="col-lg-12">
				<div class="input-group" style="direction:ltr; margin-bottom:3px; width:100%;">
					<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:230px;">Corpus d'expérimentation</span>
					<input class="form-control" type="file" name="corpus" />
				</div>
			</div>
			<div class="col-lg-12">
				<div class="input-group" style="direction:ltr; margin-bottom:3px; width:100%;">
					<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:230px;">Service Composite Sélectionné</span>
					<input class="form-control" type="file" name="service" />
				</div>
			</div>
			<div class="col-lg-12">
				<div class="input-group" style="direction:ltr; margin-bottom:3px; width:100%;">
					<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:230px;">Algorithme d'orchestration</span>
					<input class="form-control" type="text" name="algorithme" value="http://localhost:51002/ServiceOrchestration.asmx?WSDL" />
				</div>
			</div>
		</div>
	</form>
	<input id="orchestration-generer" type="button" class="btn btn-block social-tumblr" value="Lancer l'algorithme d'orchestration" />
</div>

<div class="row" style="margin:0 -10px;">
	<div class="col-lg-6">
		<div class="panel" style="padding:10px; margin-bottom:10px;">
			<pre data-plugin="highlight" style="height:348px; overflow-y:auto; overflow-x:hidden; margin-bottom:3px;"><code id="orchestration-bpel" class="xml">aa</code></pre>

			<input id="selection-bpel-download" disabled type="button" class="btn btn-block social-tumblr" value="Fichier BPEL" />
		</div>
	</div>
	
	<div class="col-lg-6">
		<div class="panel" style="padding:10px; margin-bottom:10px;">
			<pre data-plugin="highlight" style="height:348px; overflow-y:auto; overflow-x:hidden; margin-bottom:3px;"><code id="orchestration-wsdl" class="xml">aa</code></pre>

			<input id="selection-wsdl-download" disabled type="button" class="btn btn-block social-tumblr" value="Fichier WSDL" />
		</div>
	</div>
</div>
