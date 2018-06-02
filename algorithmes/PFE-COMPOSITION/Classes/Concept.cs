using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace PFE_COMPOSITION
{
    public class Concept
    {
        public string id { get; set; }
        public List<string> subconcept { get; set; }

        public Concept()
        {
        }

        /*
        private bool valeurAjoute { get; set; }
        private int distanceToOutputs { get; set; }
        private int distanceToInputs { get; set; }

        public Concept()
        {
            this.valeurAjoute = false;        
        }

        public void setValeurAjoute(bool b) { valeurAjoute = b; }
        public bool getValeurAjoute() { return valeurAjoute; }
        public void setDistanceToOutputs(int b) { distanceToOutputs = b; }
        public void setDistanceToInputs(int b) { distanceToInputs = b; }
        public int getDistanceToOutputs() { return distanceToOutputs; }
        public int getDistanceToInputs() { return distanceToInputs; }*/
    }
}