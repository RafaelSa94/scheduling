#pragma once

#include <iostream>
#include <map>

using namespace std;
class Data {
private:
  map<ColorNode, vector<ColorNode> g;
  string file;
  void load(string file);

public:
  Data ();
  map<ColorNode, vector<ColorNode> getMap();
  virtual ~Data ();
};
