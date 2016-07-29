#include "../header/graph.hpp"

vector<int> ColorGraph::getAdj(int node) {
  return this->g.at(node);
}

void ColorGraph::setVertColor(int node, Color c){
  for (int i = 0; i < this->v.size(); i++   ) {
    if (this->v[i]->getId() == node) {
      this->v[i]->setColor(c);
      break;
    }
  }
}
