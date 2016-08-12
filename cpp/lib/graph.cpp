#include "../header/graph.hpp"

vector<int> ColorGraph::getAdj(int node) {
  return this->g.at(node);
}

void ColorGraph::setVertColor(int node, Color c){
    this->v.at(node)->setColor(c);
}

int ColorGraph::vertQuantity() {
  return this->v.size();
}

ColorNode* ColorGraph::getNode(int node) {
  return this->v.at(node);
}

vector<int> ColorGraph::getVertices() {
    vector<int> v;
    for(auto& it : this->v) {
      v.push_back(it.first);
    }
    return v;
}

vector<Color> ColorGraph::getAdjColors(int node) {
  vector<int> adj = this->g.at(node);
  vector<Color> colors;
  for(int i = 0; i < adj.size(); i++) {
    colors.push_back(this->v.at(adj[i])->getColor());
  }

  return colors;

}
