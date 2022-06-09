package com.example.test54;
import java.util.*;
import java.lang.*;

class Graph{
    List<Integer> poc = new ArrayList<>();

    String shortestP;
    // create findHamiltonianCycle() method to get minimum weighted cycle
    public int findHamiltonianCycle(int[][] distance, boolean[] visitCity, int currPos, int cities, int count, int cost, int hamiltonianCycle,String str,String shortestPah)
    {


        if (count == cities && distance[currPos][0] > 0)
        {
            hamiltonianCycle = Math.min(hamiltonianCycle, cost + distance[currPos][0]);

            if(hamiltonianCycle<cost+distance[currPos][0]){

            }
            else{

                shortestP=str;
                System.out.println("--------"+shortestP);
            }

            System.out.println("count: "+count+" curr_pos: "+(currPos)+" cost: "+hamiltonianCycle);
            System.out.println("["+currPos+"]"+"["+0+"]:"+distance[currPos][0]);
            poc.add(distance[currPos][0]);
            return hamiltonianCycle;

        }

        // BACKTRACKING STEP
        for (int i = 0; i < cities; i++)
        {
            if (visitCity[i] == false && distance[currPos][i] > 0)
            {
                //System.out.println("count: "+count+" curr_pos: "+(currPos+1)+" cost: "+cost+distance[currPos][i]);
                System.out.println("["+currPos+"]"+"["+i+"]:"+distance[currPos][i]);
                poc.add(distance[currPos][i]);
                // Mark as visited
                visitCity[i] = true;
                String str1 =str+i+"::";
                hamiltonianCycle = findHamiltonianCycle(distance, visitCity, i, cities, count + 1, cost + distance[currPos][i], hamiltonianCycle,str1,shortestPah);

                // Mark ith node as unvisited
                visitCity[i] = false;
            }
        }
        return hamiltonianCycle;
    }


}


