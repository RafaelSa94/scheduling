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
      int v = stoi(t[0]);
      vector<int> edges;
      vector<string> e;
      split(t[1], ',', e);

      for(int i = 0; i < e.size(); i++) {
        edges.push_back(stoi(e[i]));
      }

      this->g.insert(make_pair (v, edges));
      vector<Color> colors;
      vector<string> r;
      split(t[2], ',', r);
      for(int i = 0; i < r.size(); i++) {
        colors.push_back((Color)stoi(r[i]));
      }

      this->v.insert(make_pair(v,new ColorNode(v, colors)));
    }
    csv_file.close();


}


Data::~Data(){
  for (int i = 0; i < this->v.size(); i++) {
    delete(this->v.at(i));
  }

}
