using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace PFE_COMPOSITION
{
    public class ResultsComposition
    {
        public string optimisations { get; set; }
        public double timeOptimisation { get; set; }
        public double timeGeneration { get; set; }
        public double timeMatrice { get; set; }
        public double timeTotal { get; set; }
        public bool error { get; set; }
        public string message { get; set; }
        public int countCompositions { get; set; }
        public int countTested { get; set; }
        public List<Composition> compositions { get; set; }

        public ResultsComposition()
        {
            this.compositions = new List<Composition>();
            this.message = "";
            this.optimisations = "";
            this.error = false;
            this.countCompositions = 0;
            this.countTested = 0;
            this.timeGeneration = 0;
            this.timeOptimisation = 0;
            this.timeMatrice = 0;
            this.timeTotal = 0;
        }
    }
}