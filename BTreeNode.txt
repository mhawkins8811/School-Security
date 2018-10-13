z/********************************************************
 ** Simple Program to implement insertions              **
 ** and traversal on B-trees                            **
 ** This file includes basic operations on B-tree nodes **
 ** Programmed by Olac Fuentes                          **
 ** Last modified February 23, 2015                     **
 ** Report bugs to me                                   **
 *********************************************************/
/*
 * Michael Manzanares
 * This lab deal with the Binary Search Trees and different methods pertaining to BST 
 * Lab 5
 * Dr. Fuentes
 * TA: Saiful Abu
 * 03/18/2016
 * Objective:In this lab you will practice using Binary Search Trees.
 * */
public class BTreeNode{
	public int[] key;
	public BTreeNode[] c;
	boolean isLeaf;
	public int n;
	public int nodesCount;
	private int T; //Each node has at least T-1 and at most 2T-1 keys
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
	public  BTreeNode(int t){
		T = t;
		isLeaf = true;
		key = new int[2*T-1];
		c = new BTreeNode[2*T];
		n=0;	
	}
	/*public int min(BTreeNode B){
		if(isLeaf){
			return key[0];
		}
		else{
			return min(c[0]);
		}
	}*/
	public int max(){
		if(isLeaf){
			return key[n-1];//returns the highest index of 
		}
		else{
			return c[n].max();//travels to the highest index of child nodes
		}
	}
	public int min(){
		if(isLeaf){
			return key[0];//returns the 0 index of key
		}
		else{
			return c[0].min();//travels to the lowest index
		}
	}

	public boolean isFull(){
		return n==(2*T-1);
	}

	public boolean search(int PossibleNewkey){//returns true if found
		int i = 0;//index
		while(i<n&&PossibleNewkey>=key[i]){//finds the address to the key
			if(i<n&&PossibleNewkey== key[i]){
				return true;//returns true if found
			}
			i++;
		}
		if(isLeaf){
			//return c[i].search(PossibleNewkey);//moves onto the next 
			return false;
		}
		else{
			//return false;
			return c[i].search(PossibleNewkey);//moves onto the next 
		}
	}
	

	public void insert(int newKey){
		// Instert new key to current node
		// We make sure that the current node is not full by checking and
		// splitting if necessary before descending to node
		//System.out.println("inserting " + newKey); // Debugging code
		//TODO need to add an if statement here to catch the duplicate, make a boolean 
		//if(search(newKey)==true){
		int i=n-1;//starting from top to low?
		if (isLeaf){//if it is a leaf
			while ((i>=0)&& (newKey<key[i])) {//then while i decreases and the newkey finds its slot
				key[i+1] = key[i];//TODO shifting the elements  
				i--;//decrements i
			}
			n++;//increases the size of n
			key[i+1]=newKey;//places the new element inside of 
		}
		else{
			while ((i>=0)&& (newKey<key[i])) {
				i--;
			}
			int insertChild = i+1;  // Subtree where new key must be inserted
			if (c[insertChild].isFull()){
				// The root of the subtree where new key will be inserted has to be split
				// We promote the mediand of that root to the current node and
				// update keys and references accordingly
				System.out.println("This is the full node we're going to break ");// Debugging code
				//c[insertChild].printNodes();
				//System.out.println("going to promote " + c[insertChild].key[T-1]);
				n++;//
				c[n]=c[n-1];//since it is decrementing rather than incrementing, it is shifting//TODO but what exactly 
				for(int j = n-1;j>insertChild;j--){//decre
					c[j] =c[j-1];//shifting
					key[j] = key[j-1];//shifting 
				}
				key[insertChild]= c[insertChild].key[T-1];//placing the insertChild = into the new child spot, with the keys 
				c[insertChild].n = T-1;//
				BTreeNode newNode = new BTreeNode(T);//now a new node is to be made
				nodesCount +=1;
				for(int k=0;k<T-1;k++){//begins shifting for the new node 
					newNode.c[k] = c[insertChild].c[k+T];//shift
					newNode.key[k] = c[insertChild].key[k+T];//shift
				}
				newNode.c[T-1] = c[insertChild].c[2*T-1];//the formulat 2(n-1)
				newNode.n=T-1;//(n-1)
				newNode.isLeaf = c[insertChild].isLeaf;
				c[insertChild+1]=newNode;

				if (newKey <key[insertChild]){
					c[insertChild].insert(newKey);					}
				else{
					c[insertChild+1].insert(newKey);				}
			}
			else
				c[insertChild].insert(newKey);
		}
		//	}
	}



	public int countNodes(){
		int count = 1;//start with the count of the node you are at
		if(isLeaf){
			return 1;//return 1 if leaf
		}
		else{
			//count+=1;
			for(int i = 0;i<=n;i++){
				count+=c[i].countNodes();//counts and traverses nodes
			}
		}
		return count;
	}
	public int numberOfLeaves(){//works
		int count = 0;//starts at o
		if(isLeaf){
			return 1;
		}

		else{
			for(int i = 0; i<=n;i++){
				
					count +=c[i].numberOfLeaves();
				
			}
		}
		return count;
	}

	public int countKeys(){
		int count = n;//all you need is n!
		if(isLeaf){
			return count;
		}
		else{
			for(int i = 0;i<=n;i++){//traverses the nodes and bc the length can be found with n, just equal it to count and just add the n 
				count=c[i].countKeys()+count;
			}
		}
		return count;
	}
	int depthDlevel(int d){
		int count = 0;
		if(isLeaf){
			if(d==0){//once d ==0
				return 1;// return if this node is a leaf
			}
		}
		else{
			if(d==0){//if not a leaf 
				count+=1;//increment
			}
			for(int i=0;i<=n;i++){
				count +=c[i].depthDlevel(d-1);//recursive call to manuever 
			}
		}
		return count;
	}
	int exactlyNnodes(int nn){
		int count = 0;//all you need is n!
		if(isLeaf){
			if(n==nn){//if a leaf and n ==nn
				return 1;
			}
		}
		else{
			if(n==nn){//if not a leaf
				count+=1;
			}
			for(int i = 0;i<=n;i++){
				count +=c[i].exactlyNnodes(nn);
			}//traverses the child node

		}
		return count;
	}
	int fullNodes(){
		int count = 0;//all you need is n!
		if(isLeaf){
			if(key.length==n){
				return 1;//if a leaf and key.length==n 
			}
		}
		else{
			if(key.length==n){//if not a leaf 
				count+=1;
			}
			for(int i = 0;i<=n;i++){
				count+=c[i].fullNodes();//traversing thorugh the child nodes
			}
			
		}
		return count;
	}
	
	public int minTmin1(){
		int count = 0;
		if(isLeaf){
			if(n==(T-1)){//if the leaf is min
				return 1;
			}
		}
		else{
			if(n==(T-1)){//if not a leaf and it is the min
				count +=1;
			}
			for(int i = 0;i<=n;i++){

				count+=c[i].minTmin1();//travels teh child nodes

			}
		}
		return count;
	}
	public void print(){
		//Prints all keys in the tree in ascending order
		if (isLeaf){
			for(int i =0; i<n;i++)
				System.out.print(key[i]+" ");
			System.out.println();
		}
		else{
			for(int i =0; i<n;i++){
				c[i].print();
				System.out.print(key[i]+" ");
			}
			c[n].print();
		}
	}
	public void printDescending(){
		//Prints all keys in the tree in Descending order
		if (isLeaf){
			for(int i =n-1; i>=0;i--)
				System.out.print(key[i]+" ");
			System.out.println();
		}
		else{
			c[n].printDescending();//for the first node 
			for(int m =n-1; m>=0;m--){
				System.out.print(key[m]+" ");
				c[m].printDescending();
			}
		}
	}
	public int countKeysSum(){
		int count = 0;//all you need is n!
		if(isLeaf){
			for(int i = 0; i<n;i++){//if it is a leaf and going to count the key values
				count+=key[i];
			}
			return count;
		}
		else{
			for(int j = 0; j<n;j++){
				count+=key[j];//not a leaf but counting the keys values
			}
			for(int i = 0;i<=n;i++){
				count+=c[i].countKeysSum();//traveling through the child nodes 
			}	
		}
		return count;
	}
	public void printNodes(){
		//Prints all keys in the tree, node by node, using preorder
		//It also prints the indicator of whether a node is a leaf
		//Used mostly for debugging purposes
		for(int i =0; i<n;i++)
			System.out.print(key[i]+" ");
		System.out.println(isLeaf);
		if (!isLeaf){
			for(int i =0; i<=n;i++){
				c[i].printNodes();
			}
		}
	}
}
