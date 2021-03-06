/***********************************************
** Simple Program to implement insertions     **
** and traversal on B-trees                   **
** Main program to build and print B-tree     **
** Programmed by Olac Fuentes                 **
** Last modified February 23, 2015            **
** Report bugs to me                          **
************************************************/
import java.util.*;

public class BTreeTest{
	/*
	 * Michael Manzanares
	 * This lab deal with the Binary Search Trees and different methods pertaining to BST 
	 * Lab 5
	 * Dr. Fuentes
	 * TA: Saiful Abu
	 * 03/18/2016
	 * Objective:In this lab you will practice using Binary Search Trees.
	 * */
	 public static void main(String[] args)   {
	 	int [] S ={2,2,4,4,6,3,1,10};
	 	Random generator = new Random();
		BTree T = new BTree(3);
		BTreeNode BT = new BTreeNode(3);
		/*
		 *(a)  Print the keys in the tree in descending order (done)
	      (b)  Determine if a given element k is in the tree.(done)
	      (c)  Return the minimum element in the tree(done)
	      (d)  Return the maximum element in the tree(done)
	      (e)  Return the number of nodes in the tree(done)
	      (f)  Return the number of keys in the tree(done)
	      (g)  Return the sum of all the keys in the tree(done)
	      (h)  Return the number of leaves in the tree(done)
	      (i)  Return the number of nodes in the tree that are full(woi)**
	      (j)  Return the number of nodes in the tree that have the minimum number of keys(woi)**(done)
	      (k)  Given an integer n, return the number of nodes in the tree that have exactly n keys(woi)**(done)
	      (l)  Given an integer d, return the number of nodes in the tree that have depth d (woi)**(done)
		 */
		
		//for (int i=0;i<S.length;i++){
      for (int i=0;i<80;i++){
			//T.insert(S[i]);
			//T.printNodes();
			//System.out.println();
			T.insert(generator.nextInt(1000));
		}
		T.printNodes();
		T.print();

		T.printnumBerOfKeys();//bulletin
		T.printnumBerOfNodes();//bulletin
		T.printDescending();//(a)
		T.printSearch(4);//(b)
		T.printMin();//(c)
		T.printMax();//(d)
		T.printCountNodes();//(e)
		T.printCountKeys();//(f)
		T.countKeysSum();//(g)
		T.printnumberOfLeaves();//(h)
		T.fullNodes();//(i)
		T.printminTmin1();//(j)
		T.exactlyNnodes(2);//(k)
		T.depthDlevel(1);//(l)
	 
	}
}
