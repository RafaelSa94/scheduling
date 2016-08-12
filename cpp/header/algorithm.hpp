#pragma once

#include "graph.hpp"
#include <list>
#include <iostream>
#include <memory>
#include <fstream>
#include <algorithm>

using namespace std;
class GraphAlgorithm {
protected:
  ColorGraph g;
public:
  GraphAlgorithm (ColorGraph g) : g(g) { };
  void exportGraph(string file);
  virtual void run() = 0;
  virtual ~GraphAlgorithm () {};
};

class ColoringAlgorithm : public GraphAlgorithm {
private:
  vector<int> coloring_order;
  bool sort(int i, int j);
  int colors_available;
  Color last_color;

  void genColoringOrder();
  Color getAvailableColor(int node);
public:
  ColoringAlgorithm (ColorGraph g, int colors_available)
    : GraphAlgorithm(g), colors_available(colors_available) { this->genColoringOrder();};
  virtual void run();
  virtual ~ColoringAlgorithm () {};
};
