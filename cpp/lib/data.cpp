#include "../header/data.hpp"

namespace {
  void split(const string& s, char delim,vector<string>& v) {
    auto i = 0;
    auto pos = s.find(delim);
    while (pos != string::npos) {
      v.push_back(s.substr(i, pos-i));
      i = ++pos;
      pos = s.find(delim, pos);

      if (pos == string::npos)
         v.push_back(s.substr(i, s.length()));
    }
  }
}

void Data::load(string file) {
  ifstream csv_file(file);
  if(!csv_file.is_open()) {
    cerr << "Error opening file: " << file << "\n";
  }

  string line;
  while ( getline (csv_file,line) )
    {
      vector<string> t;
      split(line, ';', t);

      int vert = stoi(t[0]);
      // cout << "Vert: " << vert << "\n";
      vector<string> e;
      vector<int> edges;
      if(!t[1].empty()){
        split(t[1], ',', e);
        if(e.size() == 0) {
          // cout << "\tVert: " << t[1] << "\n";
          edges.push_back(stoi(t[1]));
        }
        else {
          for(int i = 0; i < e.size(); i++) {
            // cout << "\tVert: " << stoi(e[i]) << "\n";
            edges.push_back(stoi(e[i]));
          }
        }
      }

      this->g.insert(make_pair (vert, edges));
      vector<Color> colors;
      vector<string> r;

      if(!t[2].empty()){
        split(t[2], ',', r);
        if(r.size() == 0) {
          // cout << "\t\tVert: " << t[2] << "\n";
          colors.push_back((Color)stoi(t[2]));
        }
        else {
          for(int i = 0; i < r.size(); i++) {
            colors.push_back((Color)stoi(r[i]));
          }
        }
      }
      //
      auto colorNode = new ColorNode(vert, colors);
      this->v.insert(make_pair(vert, colorNode));
    }
    csv_file.close();


}

map<int, vector<int>> Data::getMap() {
  return this->g;
}

map<int, ColorNode*> Data::getVector() {
  return this->v;
}

Data::~Data(){
  for (auto& i : this->v) {
    delete(this->v.at(i.first));
  }

}
