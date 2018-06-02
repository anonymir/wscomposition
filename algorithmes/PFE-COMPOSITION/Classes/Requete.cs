using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace PFE_COMPOSITION
{
    public class Requete
    {
        //public Dictionary<string, Service> hs { get; set; }

        public List<string> input { get; set; }
        public List<string> output { get; set; }

        public bool Optimiser(Corpus c)
        {
            for (int i = 0; i < this.input.Count; i++)
            {
                //this.input[i] = this.input[i].ToUpper().Trim();

                if (c.allConcepts.ContainsKey(this.input[i]))
                    this.input[i] = c.allConcepts[this.input[i]].id;
                else
                    this.input[i] = "X";
            }
            for (int i = 0; i < this.output.Count; i++)
            {
                //this.output[i] = this.output[i].ToUpper().Trim();

                if (c.allConcepts.ContainsKey(this.output[i]))
                    this.output[i] = c.allConcepts[this.output[i]].id;
                else
                    this.output[i] = "X";
            }

            if (this.input.Contains("X") || this.output.Contains("X"))
                return false;

            foreach (string i in this.input)
                if (this.output.Contains(i))
                    while (this.output.Remove(i)) ;

            if (this.input.Count == 0 || this.output.Count == 0)
                return false;

            return true;
        }

        public static Requete charger(string i, string o)
        {
            Requete r = new Requete();
            r.input = Requete.getList(i);
            r.output = Requete.getList(o);
            return r;
        }

        public static List<string> getList(string st)
        {
            List<string> list = new List<string>();

            foreach (string s in st.Split(' '))
                if (s != "" && list.Contains(s) == false)
                    list.Add(s);

            return list;
        }
    }
}