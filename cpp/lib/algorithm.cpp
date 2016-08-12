#include "../header/algorithm.hpp"

void GraphAlgorithm::exportGraph(string file) {
  ofstream csv_file(file);
  for(auto& vertex : this->g.getVertices()) {
    csv_file << vertex << ";" << (int)this->g.getNode(vertex)->getColor() << endl;
  }
}

void ColoringAlgorithm::run() {
  //unsigned int colors_necessary = 0;
  last_color = (Color)0;

  for(int i = 0; i < coloring_order.size(); i++) {
    int node = coloring_order[i];
    Color c = getAvailableColor(node);
    g.setVertColor(node, c);
  }
}

Color ColoringAlgorithm::getAvailableColor(int node) {
  vector<Color> adj_restrictions = this->g.getAdjColors(node);


  for(int i = 0; i < colors_available; i++) {
    bool available;

    int color = (i + (int)last_color) % colors_available;

    available = this->g.getNode(node)->testColor((Color)color);

    // Verifica restrições adjacentes
    for(Color rest_c : adj_restrictions) {
      if(!available)
        break;
      if(rest_c == (Color)color) {
        available = false;
      }
    }

    if(available) {
      last_color = (Color)color;
      return (Color)color;
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
