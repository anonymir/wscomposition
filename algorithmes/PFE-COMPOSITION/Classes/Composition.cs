using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace PFE_COMPOSITION
{
    public class Composition
    {
        public List<string> services { get; set; }
        public List<Relation> relations { get; set; }
        public int distance = 0;

        private Corpus corpus { get; set; }
        private Requete requete { get; set; }
        private Service start { get; set; }
        private Service end { get; set; }

        public HashSet<string> parameters { get; set; }


        public Composition() { }

        public Composition(Corpus c, Requete r)
        {
            corpus = c;
            requete = r;

            parameters = new HashSet<string>();
            services = new List<string>();
            relations = new List<Relation>();
            start = new Service("START", new List<string>(), requete.input);
            end = new Service("END", requete.output, new List<string>());

            //parameters.AddRange(r.input);

            if (corpus.hs.ContainsKey(start.id) == false)
            {
                corpus.services.Add(start);
                corpus.services.Add(end);
                corpus.hs.Add(start.id, start);
                corpus.hs.Add(end.id, end);
                services.Add("START");

                foreach (string e in requete.input)
                    parameters.Add(e);
            }
        }

        public HashSet<string> GetParameters()
        {
            return parameters;
        }

        public bool AddEnd()
        {
            List<Relation> newRelations = new List<Relation>();

            foreach (string i in end.input)
            {
                bool conditionInputs = false;

                foreach (string s in services)
                    //if (Matching.Include(corpus, corpus.hs[s].output, i) == true)
                    if (corpus.hs[s].output.Contains(i) == true)
                    {
                        newRelations.Add(new Relation(s, end.id, i));
                        conditionInputs = true;
                        break;
                    }

                if (conditionInputs == false)
                    return false;
            }

            services.Add(end.id);
            relations.AddRange(newRelations);

            return true;
        }

        public bool AddService(Service newService)
        {
            if (newService.id == end.id || services.Contains(newService.id))
                return false;
            
            List<Relation> newRelations = new List<Relation>();

            bool conditionAddedValue = false;

            foreach (string o in newService.output)
                //if (Matching.Include(corpus, parameters, o) == false)
                if (parameters.Contains(o) == false)
                {
                    conditionAddedValue = true;
                    break;
                }

            if (conditionAddedValue == false)
                return false;

            foreach (string i in newService.input)
            {
                bool conditionInputs = false;

                foreach (string s in services)
                    //if (Matching.Include(corpus, corpus.hs[s].output, i) == true)
                    if (corpus.hs[s].output.Contains(i) == true)
                    {
                        string concept = (corpus.hc.ContainsKey(i)) ? i : corpus.hsc[i].id;

                        newRelations.Add(new Relation(s, newService.id, concept));
                        conditionInputs = true;
                        break;
                    }

                if (conditionInputs == false)
                    return false;
            }

            services.Add(newService.id);
            relations.AddRange(newRelations);

            foreach(string s in newService.output)
                parameters.Add(s); 

            return true;
        }

        public bool Complete()
        {
            foreach (string o in requete.output)
                //if (Matching.Include(corpus, parameters, o) == false)
                if (parameters.Contains(o) == false)
                        return false;

            return true;
        }
        
        public Composition Clone()
        {
            Composition clone = new Composition(corpus, requete);

            foreach (string s in this.services)
                clone.services.Add(s);

            foreach (string s in this.parameters)
                clone.parameters.Add(s);

            foreach (Relation r in this.relations)
                clone.relations.Add(new Relation(r.from, r.to, r.concept));

            return clone;
        }
    }
}