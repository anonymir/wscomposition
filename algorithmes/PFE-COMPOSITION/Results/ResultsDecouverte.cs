using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace PFE_COMPOSITION
{
    public class ResultsDecouverte
    {
        public List<Service> services { get; set; }
        public string message { get; set; }
        public bool error { get; set; }

        public ResultsDecouverte()
        {
            this.services = new List<Service>();
            this.message = "";
            this.error = false;
        }
    }
}