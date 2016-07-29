#include "../header/node.hpp"

int Node::getId() {
  return this->id;
}

Color ColorNode::getColor(){
  return this->c;
}

void ColorNode::setColor(Color new_c) {
  this->c = new_c;
}
