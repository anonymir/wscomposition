
<div class="panel" style="padding:10px; margin-bottom:10px;">
	<form id="selection-generer-form">
		<div class="row">
			<div class="col-lg-12">
				<div class="input-group" style="direction:ltr; margin-bottom:3px; width:100%;">
					<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Algorithme de validation</span>
					<input class="form-control" type="text" name="algorithme" value="http://localhost:51002/ServiceValidation.asmx?WSDL" />
				</div>
			</div>
			<div class="col-lg-6">
				<div class="input-group" style="direction:ltr; margin-bottom:3px; width:100%;">
					<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Services Start</span>
					<input class="form-control" type="text" name="temps" value="< 5000ms" />
				</div>
			</div>
			<div class="col-lg-6">
				<div class="input-group" style="direction:ltr; margin-bottom:3px; width:100%;">
					<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Services Step</span>
					<input class="form-control" type="text" name="cout" value="< 200$" />
				</div>
			</div>
			<div class="col-lg-6">
				<div class="input-group" style="direction:ltr; margin-bottom:3px; width:100%;">
					<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Services Iteration</span>
					<input class="form-control" type="text" name="disponibilite" value="> 90%" />
				</div>
			</div>
			<div class="col-lg-6">
				<div class="input-group" style="direction:ltr; margin-bottom:3px; width:100%;">
					<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Réputation</span>
					<input class="form-control" type="text" name="reputation" value="> 80%" />
				</div>
			</div>
			<div class="col-lg-6">
				<div class="input-group" style="direction:ltr; margin-bottom:3px; width:100%;">
					<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Fiabilité</span>
					<input class="form-control" type="text" name="fiabilite" value="> 80%" />
				</div>
			</div>
		</div>
	</form>
	<input id="selection-generer" type="button" class="btn btn-block social-tumblr" value="Lancer l'algorithme de sélection" />
</div>

<div class="row" style="margin:0 -10px;">
	<div class="col-lg-6">
		<div class="panel" style="padding:10px; margin-bottom:10px;">
			<pre data-plugin="highlight" style="height:348px; overflow-y:auto; overflow-x:hidden; margin-bottom:3px;"><code id="selection-results" class="json"></code></pre>

			<input id="selection-results-download" disabled type="button" class="btn btn-block social-tumblr" value="Résultat retourné par l'algorithme de sélection" />
		</div>
	</div>
	
	<div class="col-lg-6">
		<div class="panel" style="padding:10px; margin-bottom:10px;">
			<div id="selection-view" class="bg-grey-100" style="height:348px; overflow-y:auto; overflow-x:auto; margin-bottom:3px;">

			</div>

			<select id="selection-list" class="form-control" disabled>
				<option value="null" selected="1" style="display:none;">Représentation graphique du service sélectioné</option>
			</select>
		</div>
	</div>
</div>
