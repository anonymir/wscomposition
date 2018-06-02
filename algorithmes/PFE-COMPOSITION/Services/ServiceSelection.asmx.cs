using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Services;

namespace PFE_COMPOSITION
{
    /// <summary>
    /// Description résumée de ServiceSelection
    /// </summary>
    [WebService(Namespace = "http://tempuri.org/")]
    [WebServiceBinding(ConformsTo = WsiProfiles.BasicProfile1_1)]
    [System.ComponentModel.ToolboxItem(false)]
    // Pour autoriser l'appel de ce service Web depuis un script à l'aide d'ASP.NET AJAX, supprimez les marques de commentaire de la ligne suivante. 
    // [System.Web.Script.Services.ScriptService]
    public class ServiceSelection : System.Web.Services.WebService
    {
        private ServiceComposition serviceComposition;
        private Agregation agreagation;
        private ResultsSelection results;

        [WebMethod]
        public string SelectService(string jsonDecouverte)
        {

            return "";
        }

        [WebMethod]
        public string SelectComposition(string jsonComposition)
        {

            return "";
        }
    }
}
