#pragma once

#include "graph.hpp"
#include <iostream>
#include <memory>

using namespace std;
class GraphAlgorithm {
protected:
  ColorGraph* g;
public:
  GraphAlgorithm ();
  virtual void run();
  virtual ~GraphAlgorithm ();
};


class ColoringAlgorithm : public GraphAlgorithm {
public:
  ColoringAlgorithm (map<ColorNode, vector<ColorNode>> g);
  virtual void run();
  virtual ~ColoringAlgorithm ();
};
