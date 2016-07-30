#pragma once

#include "../header/node.hpp"
#include <iostream>
#include <map>
#include <vector>
#include <fstream>



using namespace std;
class Data {
private:
  map<int, vector<int>> g;
  map<int, ColorNode*> v;

public:
  Data () {};
  void load(string file);
  map<int, vector<int>> getMap();
  map<int, ColorNode*> getVector();
  virtual ~Data ();
};
