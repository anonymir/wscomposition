using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace PFE_COMPOSITION
{
    public class Graphe
    {
        /*
        public Dictionary<string, object> noueds = new Dictionary<string, object>();
        public Dictionary<string, List<string>> relations = new Dictionary<string, List<string>>();
        public Dictionary<string, List<string>> relationsInverse = new Dictionary<string, List<string>>();*/

        public Dictionary<string, HashSet<string>> serviceInputs = new Dictionary<string, HashSet<string>>();
        public Dictionary<string, HashSet<string>> serviceOutputs = new Dictionary<string, HashSet<string>>();
        public Dictionary<string, HashSet<string>> outputServices = new Dictionary<string, HashSet<string>>();
        public Dictionary<string, HashSet<string>> inputServices = new Dictionary<string, HashSet<string>>();
    }
}