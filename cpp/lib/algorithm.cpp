#include "../header/algorithm.hpp"

namespace {
  const size_colors = 10;

  bool max_color_node (ColorNode a, ColorNode b) {
    return (a.restrictionQuantity() > b.restrictionQuantity());
  }
}


void ColoringAlgorithm::run() {
  unsigned int colors_necessary = 0;

  list<int> coloring_order;
  int last = 0;
  coloring_order.push_front(0);
  for(int i = 1; i < this->g.vertQuantity()) {
    int length = this->g.getNode(i)->restrictionQuantity();

    if(this->g.getNode(coloring_order[last])->restrictionQuantity() < length) {
      coloring_order.push_back(i);
      last++;
    }
    else {
      for(int j = 0; j < this->g.vertQuantity()) {
        if(g.getNode(coloring_order[j])->restrictionQuantity() > length) {
          coloring_order.insert(j, i);
        }
      }
    }
  }

  for(int i = 0; i < this->g.vertQuantity(); i++) {
    auto restrictions = this->g.getAdjColors(i);


  }

}
