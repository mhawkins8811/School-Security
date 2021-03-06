/**********************************************
 ** Simple Program to implement insertions ** and traversal on B-trees ** This
 * file includes the basic B-tree class ** Programmed by Olac Fuentes ** Last
 * modified February 23, 2015 ** Report bugs to me **
 **********************************************/
/*
 * Michael Manzanares
 * This lab deal with the Binary Search Trees and different methods pertaining to BST 
 * Lab 5
 * Dr. Fuentes
 * TA: Saiful Abu
 * 03/18/2016
 * Objective:In this lab you will practice using Binary Search Trees.
 * */
public class BTree {
	public BTreeNode root;
	private int T; // 2T is the maximum number of childen a node can have
	private int height;
	private int numBerOfKeys;
	public int numberOfNODES;

	public BTree(int t) {
		root = new BTreeNode(t);
		T = t;
		height = 0;
	}

	/*
	 * public int max(BTreeNode B){ if(B.isLeaf){ return B.key[numBerOfKeys]; }
	 * else{ return max(B.c[numBerOfKeys-1]); } }
	 */

	/*public int min(BTreeNode B) {
		if (B.isLeaf) {
			return B.key[0];
		} else {
			return min(B.c[0]);
		}
	}*/

	public void printCountNodes() {
		System.out.println("This is the number of nodes: " + root.countNodes());
	}

	public void countKeysSum() {
		System.out.println("The sum of all the keys are: "
				+ root.countKeysSum());
	}

	public void printCountKeys() {
		System.out.println("The count of Keys is " + root.countKeys());
	}
	public void  depthDlevel(int d) {
		System.out.println("amount of nodes at depth d is " + root.depthDlevel(d));
	}
	public void printnumberOfLeaves() {
		System.out.println("The number of leaves is " + root.numberOfLeaves());
	}
	public void exactlyNnodes(int n) {
		System.out.println("The number of n nodes being what the paramter is: " + root.exactlyNnodes(n));
	}

	public void fullNodes() {
		System.out.println("The amount of full nodes is " + root.fullNodes());
	}

	public void printSearch(int key) {
		System.out.println("Here is search in Boolean " + root.search(key));
	}

	public void printHeight() {
		System.out.println("Tree height is " + height);
	}

	public void insert(int newKey) {
		if (root.search(newKey) == false) {// if it is false then it was not
											// found, if it was true it has been
			numBerOfKeys = numBerOfKeys + 1;//updates teh numberofKeys variable
			if (root.isFull()) {// Split root;
				split();
				height++;
				
			}
			
			root.insert(newKey);
			numberOfNODES = root.countNodes();//updates the number of nodes variable 
		}
	}

	public void printnumBerOfKeys() {
		System.out.println("number of keys is, which is the variable not the method " + numBerOfKeys);
	}
	/*public void printnumBerOfNodes() {
		System.out.println("number of nodes is, which is the variable not the method " + root.nodesCount);
	}*/
	public void printnumBerOfNodes() {
		System.out.println("number of nodes is (the bulletin not the letter)  " + numberOfNODES);
	}
	public void printminTmin1() {
		System.out.println("The amount of nodes with min of T-1 is: " + root.minTmin1());
	}

	public void print() {
		// Wrapper for node print method
		root.print();
	}
	public void printDescending(){
		// Wrapper for node print method
		root.printDescending();
	}

	/*
	 * public void printSum(){ // Wrapper for node print method
	 * System.out.println("Here is Sum "+root.sum()); }
	 */
	public void printMax() {
		System.out.println("Here is Max " + root.max());
	}
	public void printMin() {
		System.out.println("Here is Min " + root.min());
	}
	/*
	 * public void printMin(){
	 * System.out.println("Here is Min "+root.min(root)); }
	 */

	public void printNodes() {
		// Wrapper for node print method
		
		root.printNodes();
	}

	public void split() {
		// Splits the root into three nodes.
		// The median element becomes the only element in the root
		// The left subtree contains the elements that are less than the median
		// The right subtree contains the elements that are larger than the
		// median
		// The height of the tree is increased by one

		// System.out.println("Before splitting root");
		// root.printNodes(); // Code used for debugging
		
		BTreeNode leftChild = new BTreeNode(T);
		BTreeNode rightChild = new BTreeNode(T);
		leftChild.isLeaf = root.isLeaf;
		rightChild.isLeaf = root.isLeaf;
		leftChild.n = T - 1;
		rightChild.n = T - 1;
		
		
		int median = T - 1;
		for (int i = 0; i < T - 1; i++) {
			leftChild.c[i] = root.c[i];
			leftChild.key[i] = root.key[i];
			//numberOfNODES+=1;
		}
		leftChild.c[median] = root.c[median];
		for (int i = median + 1; i < root.n; i++) {
			rightChild.c[i - median - 1] = root.c[i];
			rightChild.key[i - median - 1] = root.key[i];
		//	numberOfNODES+=1;
		}
		//numberOfNODES+=1;
		rightChild.c[median] = root.c[root.n];
		root.key[0] = root.key[median];
		root.n = 1;
		root.c[0] = leftChild;
		root.c[1] = rightChild;
		root.isLeaf = false;
		// System.out.println("After splitting root");
		// root.printNodes();
	}
}
