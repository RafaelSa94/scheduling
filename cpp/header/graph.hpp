#pragma once

#include "node.hpp"
#include <iostream>
#include <vector>
#include <map>

using namespace std;

class ColorGraph {
private:
  map<int, vector<int>> g;
  map<int, ColorNode*> v;
public:
  ColorGraph (map<int, ColorNode*> v, map<int, vector<int>> g) :
    v(v), g(g) {};
  vector<int> getAdj(int node);
  vector<Color> getAdjColors(int node);
  int vertQuantity();
  ColorNode* getNode(int node);
  vector<int> getVertices();

  void setVertColor(int node, Color c);
  virtual ~ColorGraph () { };
};
