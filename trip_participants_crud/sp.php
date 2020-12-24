<?php 
header("Content-type: text/plain");
function GraphChallenge($strArr) {

  // code goes here
  $n = count($strArr);
  $numberOfNodes = $strArr[0];
  $starNode = $strArr[1];
  $endNode = $strArr[$numberOfNodes];
  $noOfPaths = count($strArr)-$numberOfNodes-1;
  $path = array();
  $j=0;
  for($i = $numberOfNodes+1 ; $i<count($strArr); $i++) {
    // paths of nodes
    $path[$j] = $strArr[$i];
    $j++;
  }
  // shortest path
  $sp = "";
  $startToEndFound = array_search($starNode."-".$endNode, $path);
  if($startToEndFound){
    $mst = $path[$startToEndFound];
  }
  // echo array_search('-'.$endNode, $path);
  $nodes = array();
  // nodes
  for($i = 1; $i < $numberOfNodes ; $i++) {
    $nodes[$i-1] = $strArr[$i];
  }
  $count = 0;
  $pathNodePos = "";
  // path of nodes
  $sp = $endNode;
  // traverse paths of nodes
  for($i = 0 ; $i<count($path); $i++){
    // traverse nodes
    for($j = 0; $j < count($nodes); $j++) { 
      // check if pair of node available
      if($pathNodePos = array_search($nodes[$j].'-'.$endNode, $path)){
        $count++;
        // concatenate each nearest node to last node
        $sp .= '-'.$nodes[$j];
        // change last node to where node pair occurs
        $endNode = $nodes[$j];
      }
      // after found of nearest pair skip to next path
      continue; 
    }
  }
  // check if last traversed node was same as start node
  if($endNode != $starNode){
    $sp .= "-".$starNode;
  }
  return strrev($sp);

}
// keep this function call here  
echo GraphChallenge(fgets(fopen('php://stdin', 'r')));  

?>