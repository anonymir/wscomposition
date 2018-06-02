using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Script.Serialization;
using System.Web.Services;
using System.Web.Script.Serialization;

namespace PFE_COMPOSITION
{
    [WebService(Namespace = "http://tempuri.org/")]
    [WebServiceBinding(ConformsTo = WsiProfiles.BasicProfile1_1)]
    [System.ComponentModel.ToolboxItem(false)]
    // Pour autoriser l'appel de ce service Web depuis un script à l'aide d'ASP.NET AJAX, supprimez les marques de commentaire de la ligne suivante. 
    // [System.Web.Script.Services.ScriptService]
    public class ServiceDecouverte : System.Web.Services.WebService
    {
        private Corpus corpus;
        private Matching matcher;
        private Requete requete;
        private ResultsDecouverte results;

        [WebMethod]
        public ResultsDecouverte RechercheServices(string json, string inputs, string outputs)
        {
            results = new ResultsDecouverte();

            corpus = Corpus.charger(json);
            requete = Requete.charger(inputs, outputs);

            if (ValidationInputs() != "true")
            {
                results.error = true;
                results.message = "Error : Corpus Null";

                return results;
            }

            foreach (Service s in corpus.services)
            {
                bool conditionInputs = true;
                bool conditionOutputs = true;

                foreach (string i in s.input)
                    //if (Matching.Include(corpus, requete.input, i) == false)
                    if (requete.input.Contains(i) == false)
                        conditionInputs = false;

                foreach (string o in requete.output)
                    //if (Matching.Include(corpus, s.output, o) == false)
                    if (s.output.Contains(o) == false)
                        conditionOutputs = false;

                if (conditionInputs && conditionOutputs)
                    results.services.Add(s);
            }

            if (results.services.Count == 0)
            {
                results.error = true;
                results.message = "Error : No Results";
            }

            return results;
        }

        public string ValidationInputs()
        {
            if (corpus == null)
                return "Error : Corpus Null";

            if (requete.Optimiser(corpus) == false)
                return "Error : Optimiser requete (INPUTS : " + new JavaScriptSerializer().Serialize(requete.input) + " - OUTPUTS : " + new JavaScriptSerializer().Serialize(requete.output) + ")";

            foreach (Service s in corpus.services)
                if (s.Optimiser(corpus) == false)
                    return "Error : Optimiser service " + s.id;

            return "true";
        }
    }
}
