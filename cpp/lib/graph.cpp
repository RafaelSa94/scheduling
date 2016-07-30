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

int ColorGraph::vertQuantity() {
  return this->v.size();
}

ColorNode* ColorGraph::getNode(int node) {
  return this->v.at(node);
}

vector<Color> ColorGraph::getAdjColors(int node) {
  vector<int> adj = this->g.at(node);
  vector<Color> colors;
  for(int i = 0; i < adj.size(); i++) {
    colors.push_back(this->v.at(adj.at(i))->getColor());
  }

  return colors();

}
