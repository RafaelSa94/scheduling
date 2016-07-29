#pragma once

#include "node.hpp"
#include <iostream>
#include <vector>
#include <map>

using namespace std;

class ColorGraph {
private:
  map<ColorNode, vector<ColorNode>> g;
public:
  ColorGraph (map<ColorNode, vector<ColorNode>> g) : g(g) {};
  ostream &operator<<(ostream &os);
  virtual ~ColorGraph ();
};
