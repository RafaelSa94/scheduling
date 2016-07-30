#pragma once

#include "color.hpp"
#include <iostream>
#include <vector>


using namespace std;
class Node {
private:
  int id;
public:
  Node (int id) : id(id) {};
  int getId();

  virtual ~Node () {};
};

class ColorNode : public Node {
private:
  Color c;
  vector<Color> restrictions;
public:
  ColorNode (int id, vector<Color> r) :
    Node(id), restrictions(r), c(Color::BLANK) { };
  Color getColor();
  int restrictionQuantity();
  bool testColor(Color c);
  void setColor(Color new_c);
  virtual ~ColorNode () {};
};
