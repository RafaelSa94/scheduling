#include "./header/algorithm.hpp"
#include "./header/data.hpp"

int main(int argc, char const *argv[]) {
  std::string input_file(argv[1]);
  Data a;
  a.load(input_file);
  // ColorGraph g(a.getVector(), a.getMap());
  ColoringAlgorithm g(ColorGraph(a.getVector(), a.getMap()), 10);
  g.run();
  g.exportGraph("out.csv");
  return 0;
}
