#pragma once

#include "color.hpp"
#include <iostream>

using namespace std;
class Node {
private:
  int id;
public:
  Node (int id) : id(id) {};
  int getId();
  ostream &operator<<(ostream &os);
  virtual ~Node ();
};

class ColorNode : public Node {
private:
  Color c;
public:
  ColorNode (Color c);
  Color getColor();
  ostream &operator<<(ostream &os);
  void setColor(Color new_c);
  virtual ~ColorNode ();
};
