using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Script.Serialization;

namespace PFE_COMPOSITION
{
    public class Corpus
    {
        public string identifier { get; set; }
        public List<Concept> concepts { get; set; }
        public List<Service> services { get; set; }

        public Dictionary<string, Concept> allConcepts { get; set; } // Hash Sous Concepts
        public Dictionary<string, Concept> hsc { get; set; } // Hash Sous Concepts
        public Dictionary<string, Concept> hc { get; set; } // Hash Concepts
        public Dictionary<string, Service> hs { get; set; } // Hash Services
        public Dictionary<string, int> conceptIndex { get; set; } // Hash Services
        public Dictionary<int, string> indexConcept { get; set; } // Hash Services

        public static Corpus charger(string json)
        {
            object t = new JavaScriptSerializer().DeserializeObject(json);
            Corpus c = new JavaScriptSerializer().Deserialize<Corpus>(json);
            if (c != null)
            {
                c.allConcepts = new Dictionary<string, Concept>();
                c.hsc = new Dictionary<string, Concept>();
                c.hc = new Dictionary<string, Concept>();
                c.hs = new Dictionary<string, Service>();
                c.conceptIndex = new Dictionary<string, int>();
                c.indexConcept = new Dictionary<int, string>();

                int index = 0;

                foreach (Concept concept in c.concepts)
                {
                    c.allConcepts.Add(concept.id, concept);
                    c.conceptIndex.Add(concept.id, index);
                    c.indexConcept.Add(index++, concept.id);
                    c.hc.Add(concept.id, concept);

                    foreach (string sc in concept.subconcept)
                    {
                        c.allConcepts.Add(sc, concept);
                        c.hsc.Add(sc, concept);
                    }
                }
                foreach (Service service in c.services)
                    c.hs.Add(service.id, service);
            }

            return c;
        }
    }
}