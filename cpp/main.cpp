#include "./header/algorithm.hpp"
#include "./header/data.hpp"

int main(int argc, char const *argv[]) {
  if (argc < 2) {
    std::cout << "Usage: " << argv[0] << " INPUT [OUTPUT]" << endl;
    return -1;
  }
  std::string input_file(argv[1]);
  Data data;
  data.load(input_file);
  // ColorGraph g(data.getVector(), data.getMap());
  ColoringAlgorithm algorithm(ColorGraph(data.getVector(), data.getMap()), 10);
  algorithm.run();
  algorithm.exportGraph(argc > 2 ? argv[2] : "out.csv");
  return 0;
}
