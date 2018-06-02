using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Services;
using System.Web.Script.Serialization;

namespace PFE_COMPOSITION
{
    /// <summary>
    /// Description résumée de ServiceComposition
    /// </summary>
    [WebService(Namespace = "http://tempuri.org/")]
    [WebServiceBinding(ConformsTo = WsiProfiles.BasicProfile1_1)]
    [System.ComponentModel.ToolboxItem(false)]
    // Pour autoriser l'appel de ce service Web depuis un script à l'aide d'ASP.NET AJAX, supprimez les marques de commentaire de la ligne suivante. 
    // [System.Web.Script.Services.ScriptService]
    public class ServiceComposition : System.Web.Services.WebService
    {
        private DateTime time;
        private DateTime start;
        private Corpus corpus;
        private Requete requete;
        private Graphe g;
        private ResultsComposition results;
        private ServiceDecouverte serviceDecouverte;


        private List<Service> espaceRecherche;
        private HashSet<string>[] servicesPertinants;
        private List<List<string>> solutions;
        private int[,] matrice;
        
        [WebMethod]
        public ResultsComposition RechercheCompositions(string json, string inputs, string outputs, int nmax, int tmax)
        {
            results = new ResultsComposition();

            corpus = Corpus.charger(json);
            requete = Requete.charger(inputs, outputs);

            if (ValidationInputs() != "true")
            {
                results.error = true;
                results.message = ValidationInputs();

                return results;
            }

            initEspaceRecherche(tmax);


            time = DateTime.Now;
            //CompositionLargeur(tmax, nmax);
            CompositionProfondeur(tmax, nmax);
            results.timeTotal = (DateTime.Now - time).TotalSeconds;
            

            if (results.compositions.Count == 0)
            {
                results.error = true;
                results.message = "Error : No Results.";
            }
            else
                results.countCompositions = results.compositions.Count;



            return results;
        }

        private void CompositionLargeur(int tmax, int nmax)
        {

            List<Composition> levelCurrent = new List<Composition>();
            List<Composition> levelNext = new List<Composition>();

            levelCurrent.Add(new Composition(corpus, requete));
            solutions = new List<List<string>>();

            int distance = 0;

            espaceRecherche = corpus.services;

            while (levelCurrent.Count > 0 && tmax > distance++ && nmax > 0)
            {
                levelNext = new List<Composition>();

                /*
                espaceRecherche = new List<Service>();
                foreach (string s in servicesPertinants[distance - 1])
                    espaceRecherche.Add(corpus.hs[s]);
                */
                for (int i = 0; i < levelCurrent.Count && nmax > 0; i++)
                {
                    List<Composition> cpp = ConstructionComposition(levelCurrent[i]);

                    results.countTested += cpp.Count();

                    foreach (Composition newComposition in cpp)
                    {
                        if (newComposition.Complete())
                        {

                            bool solutionExiste = false;

                            foreach (List<string> sol in solutions)
                            {
                                if (ContainsAllItems(newComposition.services, sol))
                                {
                                    solutionExiste = true;
                                    break;
                                }
                            }

                            if (solutionExiste == false)
                            {
                                solutions.Add(newComposition.services);
                                results.compositions.Add(newComposition);

                                if (--nmax <= 0)
                                    break;
                            }
                        }
                        else if (levelNext.Contains(newComposition) == false)
                            levelNext.Add(newComposition);
                    }
                }

                levelCurrent.Clear();
                levelCurrent.AddRange(levelNext);
            }

            foreach (Composition c in results.compositions)
                c.AddEnd();
        }

        private void CompositionProfondeur(int tmax, int nmax)
        {
            start = DateTime.Now;
            matrice = GetMatriceDistances(corpus, g, tmax);
            results.timeMatrice = (DateTime.Now - start).TotalSeconds;

            List<Composition> levelCurrent;

            levelCurrent = new List<Composition>();
            levelCurrent.Add(new Composition(corpus, requete));
            solutions = new List<List<string>>();
            espaceRecherche = corpus.services;
            
            while (levelCurrent.Count > 0 && nmax > 0)
            {
                List<Composition> levelNext = new List<Composition>();
                Composition bestNode = GetBestNode(levelCurrent);

                if (bestNode.services.Count < tmax)
                {
                    List<Composition> cpp = ConstructionComposition(bestNode);

                    results.countTested += cpp.Count();

                    foreach (Composition newComposition in cpp)
                    {
                        if (newComposition.Complete())
                        {
                            solutions.Add(newComposition.services);
                            results.compositions.Add(newComposition);

                            if (--nmax <= 0)
                                break;
                        }
                        else
                            levelNext.Add(newComposition);
                    }

                    levelCurrent.Remove(bestNode);
                    levelCurrent.AddRange(levelNext);
                }
            }

            foreach (Composition c in results.compositions)
                c.AddEnd();
        }

        private Composition GetBestNode(List<Composition> list)
        {
            double dMin = int.MaxValue;
            double nMin = int.MaxValue;
            Composition best = new Composition();

            foreach (Composition c in list)
            {
                if(c.distance == 0)
                    c.distance = Distance(c.parameters, requete.output);

                if (c.distance < dMin || (c.distance == dMin && c.services.Count < nMin))
                {
                    dMin = c.distance;
                    nMin = c.services.Count;
                    best = c;
                }
            }

            return best;
        }

        private int DMIN(HashSet<string> a, List<string> b)
        {
            int d = 0;

            foreach (string s in b)
            {
                int min = int.MaxValue;

                foreach (string e in a)
                {
                    int des = Distance(e, s);

                    if (des < min)
                    {
                        min = des;
                    }
                }

                if (min > d)
                    d = min;
            }

            return d;
        }

        private int Distance(HashSet<string> a, List<string> b)
        {
            int d = 0;

            foreach (string s in b)
            {
                int min = int.MaxValue;

                foreach (string e in a)
                {
                    int des = Distance(e, s);

                    if (des < min)
                    {
                        min = des;
                    }
                }

                d += min;
            }

            return d;
        }

        private int Distance(string a, string b)
        {
            return matrice[corpus.conceptIndex[a], corpus.conceptIndex[b]];
        }

        public List<Composition> ConstructionComposition(Composition composition)
        {
            List<Composition> list = new List<Composition>();

            foreach (Service newService in espaceRecherche)
            {
                Composition newComposition = composition.Clone();

                if (newComposition.AddService(newService))
                {
                    bool solutionExiste = false;

                    foreach (List<string> sol in solutions)
                    {
                        if (ContainsAllItems(newComposition.services, sol))
                        {
                            solutionExiste = true;
                            break;
                        }
                    }

                    if (solutionExiste == false)
                        list.Add(newComposition);
                }
            }

            return list;
        }

        private void initEspaceRecherche(int t)
        {
            start = DateTime.Now;

            g = new Graphe();

            foreach (Concept c in corpus.concepts)
            {
                g.outputServices.Add(c.id, new HashSet<string>());
                g.inputServices.Add(c.id, new HashSet<string>());
            }

            foreach (Service s in corpus.services)
            {
                g.serviceInputs.Add(s.id, new HashSet<string>());
                g.serviceOutputs.Add(s.id, new HashSet<string>());

                foreach (string i in s.input)
                {
                    g.serviceInputs[s.id].Add(i);
                    g.inputServices[i].Add(s.id);
                }
                foreach (string o in s.output)
                {
                    g.serviceOutputs[s.id].Add(o);
                    g.outputServices[o].Add(s.id);
                }
            }

            results.timeGeneration = (DateTime.Now - start).TotalSeconds;
            
            
            start = DateTime.Now;

            HashSet<string>[] servicesPertinantsOutputs = new HashSet<string>[t];
            HashSet<string>[] servicesPertinantsInputs = new HashSet<string>[t];

            HashSet<string> currentConceptsOutputs = new HashSet<string>();
            HashSet<string> currentConceptsInputs = new HashSet<string>();
            List<string> currentPrameters = new List<string>();

            servicesPertinants = new HashSet<string>[t];

            foreach (string e in requete.output)
                currentConceptsOutputs.Add(e);
            foreach (string e in requete.input)
            {
                currentConceptsInputs.Add(e);
                currentPrameters.Add(e);
            }

            for (int currentLevel = 0; currentLevel < t; currentLevel++)
            {
                servicesPertinantsOutputs[t - 1 - currentLevel] = new HashSet<string>();
                servicesPertinantsInputs[currentLevel] = new HashSet<string>();

                // Inputs to Services

                foreach (Service s in corpus.services)
                    if (ContainsAllItems(currentPrameters, s.input))
                        servicesPertinantsInputs[currentLevel].Add(s.id);

                foreach (string s in servicesPertinantsInputs[currentLevel])
                    foreach (string c in g.serviceOutputs[s])
                        if (currentPrameters.Contains(c) == false)
                            currentPrameters.Add(c);

                currentConceptsInputs.Clear();

                foreach (string s in servicesPertinantsInputs[currentLevel])
                    foreach (string c in g.serviceOutputs[s])
                        currentConceptsInputs.Add(c);

                // Services To Outputs

                if (currentLevel > 0)
                    foreach (string s in servicesPertinantsOutputs[t - currentLevel])
                        servicesPertinantsOutputs[t - 1 - currentLevel].Add(s);

                foreach (string c in currentConceptsOutputs)
                    foreach (string s in g.outputServices[c])
                        servicesPertinantsOutputs[t - 1 - currentLevel].Add(s);

                currentConceptsOutputs.Clear();

                foreach (string s in servicesPertinantsOutputs[t - 1 - currentLevel])
                    foreach (string c in g.serviceInputs[s])
                        currentConceptsOutputs.Add(c);
            }

            double d = 100;

            for (int currentLevel = 0; currentLevel < t; currentLevel++)
            {
                servicesPertinants[currentLevel] = new HashSet<string>();

                foreach (string s in servicesPertinantsInputs[currentLevel])
                    if (servicesPertinantsOutputs[currentLevel].Contains(s))
                        servicesPertinants[currentLevel].Add(s);

                results.optimisations += servicesPertinants[currentLevel].Count + "-";

                d = d * servicesPertinants[currentLevel].Count / corpus.services.Count;
            }

            results.optimisations = d + "****" + results.optimisations;

            results.timeOptimisation = (DateTime.Now - start).TotalSeconds;
            
            return;
        }

        public int[,] GetMatriceDistances(Corpus corpus, Graphe g, int t)
        {
            int[,] matrice = new int[corpus.concepts.Count, corpus.concepts.Count];

            for (int i = 0; i < corpus.concepts.Count; i++)
                for (int j = 0; j < corpus.concepts.Count; j++)
                    matrice[i, j] = (i == j) ? 0 : int.MaxValue;

            for (int i = 0; i < corpus.concepts.Count; i++)
            {
                HashSet<string> servicesOld = new HashSet<string>();
                HashSet<string> servicesNew = new HashSet<string>();
                HashSet<string> conceptsOld = new HashSet<string>();
                HashSet<string> conceptsNew = new HashSet<string>();

                conceptsNew.Add(corpus.concepts[i].id);
                conceptsOld.Add(corpus.concepts[i].id);

                for (int currentLevel = 0; currentLevel < t; currentLevel++)
                {
                    servicesNew.Clear();

                    foreach (string c in conceptsNew)
                        foreach (string s in g.inputServices[c])
                            if (servicesOld.Contains(s) == false)
                            {
                                servicesNew.Add(s);
                                servicesOld.Add(s);
                            }

                    conceptsNew.Clear();

                    foreach (string s in servicesNew)
                        foreach (string c in g.serviceOutputs[s])
                            if (conceptsOld.Contains(c) == false)
                            {
                                conceptsNew.Add(c);
                                conceptsOld.Add(c);
                                matrice[i, corpus.conceptIndex[c]] = currentLevel + 1;
                            }
                    
                }
            }

            return matrice;
        }

        public int GetDistance(Concept c1, Concept c2)
        {
            return 0;
        }

        private bool ContainsAllItems(List<string> a, List<string> b)
        {
            return !b.Except(a).Any();
        }

        private bool ContainsAllItems(HashSet<string> a, HashSet<string> b)
        {
            foreach (string s in b)
                if (a.Contains(s) == false)
                    return false;

            return !b.Except(a).Any();
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
