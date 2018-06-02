
<div class="panel" style="padding:10px; margin-bottom:10px;">
	<form id="description-charger-form">
		<div class="input-group" style="direction:ltr; margin-bottom:3px; width:100%;">
			<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Corpus d'expérimentation</span>
			<input class="form-control" type="file" name="corpus" id="corpus" />
		</div>
		<div class="input-group" style="direction:ltr; margin-bottom:3px; width:100%;">
			<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Collection d'Ontologies</span>
			<input class="form-control" type="file" name="ontologies" multiple id="ontologies" />
		</div>
		<div class="input-group" style="direction:ltr; margin-bottom:3px; width:100%;">
			<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Collection de Services</span>
			<input class="form-control" type="file" name="services" multiple id="services" />
		</div>
		<div class="input-group" style="direction:ltr; width:100%; margin-bottom:3px;">
			<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Service de Chargement</span>
			<input id="description-loader" class="form-control" type="text" value="http://localhost/PFE/app/services/description_loader.php" />
		</div>
	</form>
	<div class="row">
		<div class="col-lg-6">
			<input id="description-charger" type="button" class="btn btn-block social-tumblr" value="Charger un Corpus Existant - JSON -" />
		</div>
		<div class="col-lg-6">
			<input id="description-new" type="button" class="btn btn-block social-tumblr" value="Charger un Nouveau Corpus" />
		</div>
	</div>
</div>

<div id="forms" class="row" style="margin:0 -10px;">
	<div class="col-lg-4">				
		<div class="panel" style="padding:10px; margin-bottom:10px;">
			<form id="description-generer-form">
				<div class="input-group" style="direction:ltr; width:100%; margin-bottom:3px;">
					<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Générateur</span>
					<input id="description-generator" class="form-control" type="text" value="http://localhost/PFE/app/services/description_generator.php" />
				</div>
				<div class="input-group" style="direction:ltr; width:100%; margin-bottom:3px;">
					<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Identificateur</span>
					<input class="form-control" type="text" name="identifier" value="corpus_1" />
				</div>
				<div class="input-group" style="direction:ltr; width:100%; margin-bottom:3px;">
					<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Nombre Concepts</span>
					<input class="form-control" type="text" name="nbConcepts" value="50" />
				</div>
				<div class="input-group" style="direction:ltr; width:100%; margin-bottom:3px;">
					<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Max Sous Concepts</span>
					<input class="form-control" type="text" name="maxSC" value="5" />
				</div>
				<div class="input-group" style="direction:ltr; width:100%; margin-bottom:3px;">
					<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Services Abstraits</span>
					<input class="form-control" type="text" name="nbServices" value="500" />
				</div>
				<div class="input-group" style="direction:ltr; width:100%; margin-bottom:3px;">
					<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Services Concrets</span>
					<input class="form-control" type="text" name="nbConcrets" value="5" />
				</div>
				<div class="input-group" style="direction:ltr; width:100%; margin-bottom:3px;">
					<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Max d'Entrées</span>
					<input class="form-control" type="text" name="maxIn" value="4" />
				</div>
				<div class="input-group" style="direction:ltr; width:100%; margin-bottom:3px;">
					<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Max de Sorties</span>
					<input class="form-control" type="text" name="maxOut" value="4" />
				</div>
				<div class="input-group" style="direction:ltr; width:100%; margin-bottom:3px;">
					<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Qualité de Service</span>
					<input class="form-control" type="text" name="qos" value="5" />
				</div>
			</form>
			
			<input id="description-generer" type="button" class="btn btn-block social-tumblr" value="Générer un corpus" />
		</div>
	
	</div>
	
	<div class="col-lg-4">
		<div class="panel" style="padding:10px; margin-bottom:10px;">
			<pre data-plugin="highlight" style="height:348px; overflow-y:auto; overflow-x:hidden; margin-bottom:3px;">
				<code id="description-json" class="json">
				</code>
			</pre>

			<input id="description-json-download" disabled type="button" class="btn btn-block social-tumblr" value="Enregistrer la version JSON" />
		</div>
	</div>
	
	<div class="col-lg-4">
		<div class="panel" style="padding:10px; margin-bottom:10px;">
			<pre data-plugin="highlight" style="height:348px; overflow-y:auto; overflow-x:hidden; margin-bottom:3px;">
				<code id="description-xml" class="xml">
				</code>
			</pre>

			<input id="description-xml-download" disabled type="button" class="btn btn-block social-tumblr" value="Enregistrer la version XML" />
		</div>
	</div>
</div>	

<div id="graphe" class="bg-grey-800" style="overflow-y:auto; overflow-x:auto; height:600px; display:none;">
</div>

<script src="template/cytoscape.js"></script>

<script>
	var forms = true;
	
	$("#description-charger" ).click(function() {
		
		$('#graphe').toggle();
		$('#forms').toggle();
		$('#description-charger-form').toggle();
		
		forms = !forms;
		
		if(forms == false)
		{
			var form = new FormData(document.querySelector("#description-charger-form"));
			var xhr = new XMLHttpRequest();
			
			xhr.open("POST", "http://localhost/PFE/app/services/description_loader.php");
			xhr.addEventListener('load', function() {
				var graphe = $.parseJSON(this.responseText);
				
				drawGraphe(graphe);
			});
			xhr.send(form);
		}
		else
			$('#graphe').clear();
	});
	
	function drawGraphe(graphe)
	{
		var test = {
			nodes: [
			  { data: { id: 'START' } },
			  { data: { id: 'S1' } },
			  { data: { id: 'S2' } },
			  { data: { id: 'S3' } },
			  { data: { id: 'END' } },
			],
			edges: [
			  { data: { source: 'START', target: 'S2', label: 'C1' } },
			  { data: { source: 'START', target: 'S2', label: 'C1'  } },
			  { data: { source: 'S2', target: 'S1', label: 'C1'  } },
			  { data: { source: 'S2', target: 'S3', label: 'C1'  } },
			  { data: { source: 'S1', target: 'S3', label: 'C1'  } },
			  { data: { source: 'S3', target: 'END', label: 'C1'  } },
			  { data: { source: 'S3', target: 'END', label: 'C1'  } },
			]
		  };
		  
		var espaceRecherche = [
			];
		
		graphe.services.forEach(function(element) {
			espaceRecherche.push( { data: { id: element.id } } );
		});
		
		graphe.concepts.forEach(function(element) {
			espaceRecherche.push( { data: { id: element.id } } );
		});
		
		var arcs = 1;
		
		graphe.services.forEach(function(element) {
			
			element.input.forEach(function(concept) {
				espaceRecherche.push( { data: { source: concept.split("_")[0], target: element.id } } );
				arcs++;
			});
			
			element.output.forEach(function(concept) {
				espaceRecherche.push( { data: { source: element.id, target: concept.split("_")[0] } } );
				arcs++;
			});
		});

		alert(arcs);
		
		var cy = window.cy = cytoscape({
		  container: document.getElementById('graphe'),

		  style: [
		    {
			  "selector": ".autorotate",
			  "style": {
				"edge-text-rotation": "autorotate"
			  }
			},
			{
			  selector: 'node',
			  style: {

				"width": "60",
				"height": "40",
				"font-size": "12px",
				
				'content': 'data(id)',
				'text-opacity': 1,
				'text-valign': 'center',
				'text-halign': 'center',
				'background-color': '#11479e',
				'color': '#FFFFFF'
			  }
			},

			{
			  selector: 'edge',
			  style: {
				'curve-style': 'bezier',
				'width': 2,
				'target-arrow-shape': 'triangle-backcurve',
				'line-color': '#9dbaea',
				'target-arrow-color': '#9dbaea',
				//'label': 'data(label)',
				//'color': '#11479e'
			  }
			}
		  ],
		  
		  elements: espaceRecherche,
		});
	}
	
	
	$("#description-generer" ).click(function() {
		updateCorpus($("#description-generator").val(), '#description-generer-form');
	});
	
	$("#description-json-download" ).click(function() {
		download($("#description-json").text(), "corpus.json", "text/json");
	});
	
	$("#description-xml-download" ).click(function() {
		download($("#description-xml").text(), "corpus.xml", "text/xml");
	});

	function updateCorpus(url, form)
	{
		$("#description-json").text("");
		$("#description-xml").text("");
		
		var form = new FormData(document.querySelector(form));
		var xhr = new XMLHttpRequest();
		
		xhr.open("POST", url);
		xhr.addEventListener('load', function() {
			var x2js = new X2JS();
			$("#description-json").text(this.responseText);
			$("#description-xml").text(vkbeautify.xml('<?xml version="1.0" encoding="UTF-8" ?>' + x2js.json2xml_str($.parseJSON(this.responseText)), 2));
			$("#description-json-download").prop('disabled', false);
			$("#description-xml-download").prop('disabled', false);
			
			$('pre code').each(function(i, block) {
				hljs.highlightBlock(block);
			});
		});
		xhr.send(form);
	}
</script>