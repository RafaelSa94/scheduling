#include "../header/node.hpp"

int Node::getId() {
  return this->id;
}

bool ColorNode::testColor(Color c) {
  for (int i = 0; i < this->restrictions.size(); i++) {
    if(this->restrictions[i] == c)
      return false;
  }
  return true;
}

Color ColorNode::getColor(){
  return this->c;
}

void ColorNode::setColor(Color new_c) {
  if(this->testColor(new_c))
    this->c = new_c;
  else {
    cerr << "Restricted color is being set for node " << this->getId() << "\n";
  }
}
