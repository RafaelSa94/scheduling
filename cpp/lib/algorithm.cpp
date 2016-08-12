#include "../header/algorithm.hpp"

void GraphAlgorithm::exportGraph(string file) {
  ofstream csv_file(file);
  for(auto& vertex : this->g.getVertices()) {
    csv_file << vertex << ";" << (int)this->g.getNode(vertex)->getColor() << endl;
  }
}

void ColoringAlgorithm::run() {
  //unsigned int colors_necessary = 0;

  for(int i = 0; i < coloring_order.size(); i++) {
    int node = coloring_order[i];
    Color c = getAvailableColor(node);
    g.setVertColor(node, c);
  }
}

Color ColoringAlgorithm::getAvailableColor(int node) {
  vector<Color> adj_restrictions = this->g.getAdjColors(node);


  for(int c = 0; c < colors_available; c++) {
    bool available;

    available = this->g.getNode(node)->testColor((Color)c);

    // Verifica restrições adjacentes
    for(Color rest_c : adj_restrictions) {
      if(!available)
        break;
      if(rest_c == (Color)c) {
        available = false;
      }
    }

    if(available) {
      return (Color)c;
    }
  }
  cerr << "No color available for node " << node << "\n";
}
bool ColoringAlgorithm::sort(int i, int j) {
  return ((this->g.getNode(i)->restrictionQuantity() + this->g.getAdj(i).size()) >
    (this->g.getNode(j)->restrictionQuantity() + this->g.getAdj(j).size()));
}

// Gerar ordem de inserção de cor baseado em casos mais problemáticos
void ColoringAlgorithm::genColoringOrder() {

  for(int i = 0; i < this->g.vertQuantity(); i++) {
    coloring_order.push_back(this->g.getVertices()[i]);
  }
  for(int i = 0; i < this->g.vertQuantity(); i++) {
    for(int j = 0; j< this->g.vertQuantity(); j++) {
      if(!this->sort(coloring_order[i],coloring_order[j])) {
        int temp = coloring_order[i];
        coloring_order[i] = coloring_order[j];
        coloring_order[j] = temp;
      }
    }
  }

}
