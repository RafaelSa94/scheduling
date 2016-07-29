#pragma once

#include "graph.hpp"
#include <iostream>
#include <memory>

using namespace std;
class GraphAlgorithm {
protected:
  ColorGraph g;
public:
  GraphAlgorithm (ColorGraph g) : g(g) { };
  virtual void run() = 0;
  virtual ~GraphAlgorithm () {};
};


class ColoringAlgorithm : public GraphAlgorithm {
public:
  ColoringAlgorithm (ColorGraph g) : GraphAlgorithm(g) {};
  virtual void run();
  virtual ~ColoringAlgorithm () {};
};
