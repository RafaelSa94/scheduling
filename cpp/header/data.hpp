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
  void load(string file);

public:
  Data ();
  map<int, int> getMap();
  map<int, ColorNode*> getVector();
  virtual ~Data ();
};
