using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace PFE_COMPOSITION
{
    public class Service
    {
        public string id { get; set; }
        //public List<Adresse> adresses { get; set; }
        public List<string> input { get; set; }
        public List<string> output { get; set; }
        /*
        private bool conditionServiceToOutput { get; set; }
        private bool conditionInputToService { get; set; }

        private int distanceToOutputs { get; set; }
        private int distanceToInputs { get; set; }
        */
        public Service() { }
        
        public Service(string idP, List<string> inputP, List<string> outputP)
        {
            this.id = idP;
            this.input = inputP;
            this.output = outputP;

            //this.adresses = new List<Adresse>();
            /*
            this.conditionInputToService = false;
            this.conditionServiceToOutput = false;*/
        }

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
        /*
        public void setConditionServiceToOutput(bool b) { conditionServiceToOutput = b; }
        public void setConditionInputToService(bool b) { conditionInputToService = b; }
        public bool getConditionServiceToOutput() { return conditionServiceToOutput; }
        public bool getConditionInputToService() { return conditionInputToService; }

        public void setDistanceToOutputs(int b) { distanceToOutputs = b; }
        public void setDistanceToInputs(int b) { distanceToInputs = b; }
        public int getDistanceToOutputs() { return distanceToOutputs; }
        public int getDistanceToInputs() { return distanceToInputs; }*/
    }
}