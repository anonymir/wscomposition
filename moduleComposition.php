
<div class="panel" style="padding:10px; margin-bottom:10px;">
	<form id="composition-executer-form">
	
		<div class="row">
			<div class="col-lg-6">
				<div class="input-group" style="direction:ltr; margin-bottom:3px; width:100%;">
					<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Corpus d'expérimentation</span>
					<input class="form-control" type="file" name="corpus" />
				</div>
			</div>
			<div class="col-lg-6">
				<div class="input-group" style="direction:ltr; margin-bottom:3px; width:100%;">
					<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Algorithme de composition</span>
					<input class="form-control" type="text" name="algorithme" value="http://localhost:51002/Services/ServiceComposition.asmx?WSDL" />
				</div>
			</div>
			<div class="col-lg-6">
				<div class="input-group" style="direction:ltr; margin-bottom:3px; width:100%;">
					<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Concepts d'entrée</span>
					<input class="form-control" type="text" name="inputs" value = "C1 C2 C3 C4 C5 C6"/>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="input-group" style="direction:ltr; margin-bottom:3px; width:100%;">
					<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Nombre Maximum</span>
					<input class="form-control" type="text" name="nmax" value = "10"/>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="input-group" style="direction:ltr; margin-bottom:3px; width:100%;">
					<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Concepts de sortie</span>
					<input class="form-control" type="text" name="outputs" value = "C10" />
				</div>
			</div>
			<div class="col-lg-6">
				<div class="input-group" style="direction:ltr; margin-bottom:3px; width:100%;">
					<span class="input-group-addon bg-blue-grey-200 blue-grey-800 text-left" style="width:200px;">Taille Maximum</span>
					<input class="form-control" type="text" name="tmax" value = "8"/>
				</div>
			</div>
		</div>
	</form>
	<input id="composition-executer" type="button" class="btn btn-block social-tumblr" value="Exécuter l'algorithme de composition" />
</div>

<div class="row" style="margin:0 -10px;">
	<div class="col-lg-12">
		<div class="panel" style="padding:10px; margin-bottom:10px;">
			<pre data-plugin="highlight" style="height:348px; overflow-y:auto; overflow-x:hidden; margin-bottom:3px;"><code id="composition-results" class="json"></code></pre>

			<input id="composition-results-download" disabled type="button" class="btn btn-block social-tumblr" value="Résultat retourné par l'algorithme de composition" />
		</div>
	</div>
	
	<div class="col-lg-12">
		<div class="panel" style="padding:10px; margin-bottom:10px;">
			<div id="composition-view" class="bg-white" style="height:648px; overflow-y:auto; overflow-x:auto; margin-bottom:3px;">

			</div>

			<select id="composition-list" class="form-control" disabled>
				<option value="null" selected="1" style="display:none;">Représentation graphique des compositions générés</option>
			</select>
		</div>
	</div>
</div>


<script src="template/cytoscape.js"></script>
  
<script>

	  
	var list = [];
	  
	$("#composition-results-download" ).click(function() {
		download($("#composition-results").text(), "composition-results.json", "text/json");
	});
	
	$("#composition-executer").click(function() {
		$("#composition-results").text("");
		
		var form = new FormData(document.querySelector('#composition-executer-form'));
		var xhr = new XMLHttpRequest();
		
		xhr.open("POST", "http://localhost/PFE/app/services/client_composition.php");
		xhr.addEventListener('load', function() {
			var x2js = new X2JS();
			var data = $.parseJSON(this.responseText);
			
			$("#composition-results").text(vkbeautify.json(JSON.stringify(data), 2));

			$('pre code').each(function(i, block) {
				hljs.highlightBlock(block);
			});
			
			if(data.results.RechercheCompositionsResult.compositions.Composition.services == null)
				list = data.results.RechercheCompositionsResult.compositions.Composition;
			else
				list = [ data.results.RechercheCompositionsResult.compositions.Composition ];
						
			$('#composition-list').children().remove();
			
			$.each(list, function (i, item) {
				$('#composition-list').append($('<option>', { 
					value: i,
					text : JSON.stringify(item.services.string)
				}));
			});
			$("#composition-list").prop('disabled', false);

			drawComposition(list.length - 1);
			
			$("#composition-results-download").prop('disabled', false);
		});
		xhr.send(form);
	});
	
	$("#composition-list").change(function() {
		drawComposition($("#composition-list").val());
	});
	
	function drawComposition(indice)
	{
		var test = {
			nodes: [
			  { data: { id: 'Utilisateur' } },
			  { data: { id: 'Fournisseur' } },
			  { data: { id: 'Description' } },
			  { data: { id: 'Decouverte' } },
			  { data: { id: 'Composition' } },
			  { data: { id: 'Selection' } },
			  { data: { id: 'Orchestration' } },
			  { data: { id: 'Exécution' } },
			],
			edges: [
			  { data: { source: 'Fournisseur', target: 'Description', label: 'Services' } },
			  { data: { source: 'Fournisseur', target: 'Description', label: 'Ontologies' } },
			  { data: { source: 'Utilisateur', target: 'Composition', label: 'Contraintes fonctionnelles'  } },
			  { data: { source: 'Utilisateur', target: 'Selection', label: 'Contraintes non fonctionnelles'  } },
			  { data: { source: 'Description', target: 'Decouverte', label: 'Corpus'  } },
			  { data: { source: 'Description', target: 'Composition', label: 'Corpus'  } },
			  { data: { source: 'Decouverte', target: 'Composition', label: 'Services à valeur ajouté'  } },
			  { data: { source: 'Composition', target: 'Selection', label: 'Resultats de composition'  } },
			  { data: { source: 'Selection', target: 'Orchestration', label: 'Service composite sélectionné'  } },
			  { data: { source: 'Orchestration', target: 'Exécution', label: 'WSDL'  } },
			  { data: { source: 'Orchestration', target: 'Exécution', label: 'BPEL'  } },
			]
		  };
		  
		var composition = {
			nodes: [
			],
			edges: [
			]
		  };
		
		list[indice].services.string.forEach(function(element) {
			var color = "#11479e";
			
			if(element == "START") color = "red";
			if(element == "END") color = "green";
				
			composition.nodes.push( { data: { id: element }, style: { 'background-color': color } });
		});

		list[indice].relations.Relation.forEach(function(element) {
			composition.edges.push( { data: { source: element.from, target: element.to, label: element.concept } } );
		});

		//alert(JSON.stringify(composition));
		
		var cy = window.cy = cytoscape({
		  container: document.getElementById('composition-view'),

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

				"width": "80",
				"height": "50",
				"font-size": "14px",
				
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
				'width': 1,
				'target-arrow-shape': 'triangle-backcurve',
				'line-color': '#9dbaea',
				'target-arrow-color': '#9dbaea',
				'label': 'data(label)',
				'color': '#11479e'
			  }
			}
		  ],
		  
		  elements: composition,
		});
	}
</script>