using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace PFE_COMPOSITION
{
    public enum Match { Exact, Plugin, Subsumant, Disjoint, Sibling, Error }

    public class Matching
    {
        public static Match Comparer(Corpus c, string x, string y)
        {
            if (c.hc.ContainsKey(x) && c.hc.ContainsKey(y) && (x == y))
                return Match.Exact;

            if (c.hsc.ContainsKey(x) && c.hsc.ContainsKey(y) && (x == y))
                return Match.Exact;

            if (c.hsc.ContainsKey(x) && c.hsc.ContainsKey(y) && (c.hsc[x].id == c.hsc[y].id))
                return Match.Sibling;

            if (c.hc.ContainsKey(x) && c.hsc.ContainsKey(y) && (x == c.hsc[y].id))
                return Match.Subsumant;

            if (c.hc.ContainsKey(y) && c.hsc.ContainsKey(x) && (y == c.hsc[x].id))
                return Match.Plugin;

            if ((c.hc.ContainsKey(x) || c.hsc.ContainsKey(x)) && (c.hc.ContainsKey(y) || c.hsc.ContainsKey(y)))
                return Match.Disjoint;
            
            return Match.Error;
        }

        public static bool Include(Corpus c, List<string> v, string s)
        {
            foreach(string a in v)
                switch (Comparer(c, a, s))
                {
                    case Match.Exact:
                    case Match.Plugin:
                    case Match.Subsumant:
                    case Match.Sibling:
                        return true;
                }

            return false;
        }
    }
}