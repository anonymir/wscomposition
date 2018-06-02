using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace PFE_COMPOSITION
{
    public class Relation
    {
        public string concept { get; set; }
        public string from { get; set; }
        public string to { get; set; }

        public Relation() { }

        public Relation(string f, string t, string c)
        {
            this.concept = c;
            this.from = f;
            this.to = t;
        }
    }
}