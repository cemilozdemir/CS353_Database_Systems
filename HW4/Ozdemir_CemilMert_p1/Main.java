import java.sql.*;

public class Main {
    public static void main(String[] args) throws SQLException {

        String mysqlUrl = "jdbc:mariadb://dijkstra.ug.bcc.bilkent.edu.tr:3306/cemil_ozdemir";
        Connection con = DriverManager.getConnection(mysqlUrl, "cemil.ozdemir", "ifyd3Dw5");
        System.out.println("Connection established...");

        Statement smt = con.createStatement();

        System.out.println("Check whether the table exists or not.");
        smt.execute("DROP TABLE IF EXISTS owns, customer, account ");
        System.out.println("Tables are dropped successfully \n");

        String customerCreate = "CREATE TABLE customer(" +
                "cid CHAR(5) primary key," +
                "name VARCHAR(30)," +
                "bdate DATE," +
                "address VARCHAR(30)," +
                "city VARCHAR(20)," +
                "nationality VARCHAR(20) ) engine=innodb;";

        System.out.println("Create customer table");
        smt.execute(customerCreate);
        System.out.println("Customer created successfully\n");

        String accountCreate = "CREATE TABLE account(" +
                "aid CHAR(8) primary key," +
                "branch VARCHAR(20)," +
                "balance FLOAT," +
                "openDate DATE ) engine=innodb;";

        System.out.println("Create account table");
        smt.execute(accountCreate);
        System.out.println("Account Created Successfully\n");

        String ownsCreate = "CREATE TABLE owns(" +
                "cid CHAR(5) references customer(cid)," +
                "aid CHAR(8) references account(aid) ) engine=innodb";

        System.out.println("Create owns table");
        smt.execute(ownsCreate);
        System.out.println("Owns created successfully\n");

        String insertCustomer = "INSERT INTO customer values('10001', 'Ayse', '1990.09.08', 'Bilkent', 'Ankara', 'TC')," +
                "('10002', 'Ali', '1985.10.16', 'Sariyer', 'Istanbul', 'TC')," +
                "('10003', 'Ahmet', '1997.02.15', 'Karsiyaka', 'Izmir', 'TC')," +
                "('10004', 'John', '2003.04.26', 'Stertford', 'Manchester', 'UK');";

        System.out.println("Insert into customer");
        smt.execute(insertCustomer);
        System.out.println("Customers inserted successfully\n");

        String insertAccount = "INSERT INTO account values('A0000001', 'Kizilay', '5000.00', '2019.11.01')," +
                "('A0000002', 'Bilkent', '228000.00', '2011.01.05')," +
                "('A0000003', 'Cankaya', '432000.00', '2012.05.14')," +
                "('A0000004', 'Sincan', '10500.00', '2012.06.01')," +
                "('A0000005', 'Tandogan', '77800.00', '2013.03.20')," +
                "('A0000006', 'Eryaman', '25000.00', '2022.01.22')," +
                "('A0000007', 'Umitkoy', '6000.00', '2017.04.21');";

        System.out.println("Insert into account");
        smt.execute(insertAccount);
        System.out.println("Account inserted successfully\n");

        String insertOwns = "INSERT INTO owns values('10001','A0000001')," +
                "('10001','A0000002')," +
                "('10001','A0000003')," +
                "('10001','A0000004')," +
                "('10002','A0000002')," +
                "('10002','A0000003')," +
                "('10002','A0000005')," +
                "('10003','A0000006')," +
                "('10003','A0000007')," +
                "('10004','A0000006');";

        System.out.println("Insert into owns");
        smt.execute(insertOwns);
        System.out.println("Owns inserted successfully\n");


        // Give the name, birthdate, and city of the youngest customer.
        String firstQuery = "SELECT name, bdate, city " +
                "FROM customer " +
                "WHERE bdate = (SELECT MAX(bdate) " +
                                "FROM customer)";
        ResultSet rs= smt.executeQuery(firstQuery);

        System.out.println(" 1) Give the name, birth date, and city of the youngest customer: \n");
        while (rs.next()){
//            System.out.println(" Cid: " + rs.getString("cid"));
            System.out.println(" Name: " + rs.getString("name"));
            System.out.println(" Birth Date: " +  rs.getString("bdate"));
//            System.out.println(" Address: " + rs.getString("address"));
            System.out.println(" City: " + rs.getString("city") + "\n");
//            System.out.println(" Nationality: " + rs.getString("nationality") + "\n");
        }

        String secondQuery = "SElECT DISTINCT name " +
                "FROM customer C, account A , owns O " +
                "WHERE C.cid = O.cid AND A.aid = O.aid AND A.balance < 50000;";
        rs = smt.executeQuery(secondQuery);

        System.out.println(" Give the names of the customers who have an account with a balance less than 50,000 TL. \n");
        while (rs.next()){
//            System.out.println(" Cid: " + rs.getString("cid"));
            System.out.println(" Name: " + rs.getString("name"));
//            System.out.println(" Birth Date: " +  rs.getString("bdate"));
//            System.out.println(" Address: " + rs.getString("address"));
//            System.out.println(" City: " + rs.getString("city") + "\n");
//            System.out.println(" Nationality: " + rs.getString("nationality") + "\n");
        }

        String thirdQuery = "SELECT A.aid, A.branch, count(*) " +
                "FROM customer C, account A, owns O " +
                "WHERE A.aid = O.aid AND C.cid = O.cid " +
                "GROUP BY O.aid " +
                "HAVING count(*) > 1";



        rs = smt.executeQuery(thirdQuery);

        System.out.println("\nGive the id and branch of the accounts who are owned by at least 2 customers.\n");
        while (rs.next()){
//            System.out.println(" Cid: " + rs.getString("cid"));
              System.out.println(" Account id: " + rs.getString("aid"));
              System.out.println(" Branch: " +  rs.getString("branch") + "\n");
//            System.out.println(" Address: " + rs.getString("address"));
//            System.out.println(" City: " + rs.getString("city") + "\n");
//            System.out.println(" Nationality: " + rs.getString("nationality") + "\n");
        }

        String fourthQuery = "SELECT A.aid, A.balance " +
                "FROM customer C, account A, owns O " +
                "WHERE A.aid = O.aid AND C.cid = O.cid AND bdate = (SELECT min(bdate) " +
                "                                                   FROM customer) " ;

        rs = smt.executeQuery(fourthQuery);

        System.out.println("\nGive the id and balance of the accounts who are owned by the oldest customer.\n");
        while (rs.next()){
//            System.out.println(" Cid: " + rs.getString("cid"));
            System.out.println(" Account id: " + rs.getString("aid"));
            System.out.println(" Balance: " +  rs.getString("balance") + "\n");
//            System.out.println(" Address: " + rs.getString("address"));
//            System.out.println(" City: " + rs.getString("city") + "\n");
//            System.out.println(" Nationality: " + rs.getString("nationality") + "\n");
        }

//        String fifthQuery = "SELECT C.cid, SUM(A.balance) as sumOf " +
//                "FROM customer C, account A, owns O " +
//                "WHERE A.aid = O.aid AND C.cid = O.cid " +
//                "GROUP BY O.cid ";

        String fifthQuery = "SELECT C.cid, MAX(sumOfBalance) " +
                "FROM (" +
                "   SELECT C.cid, SUM(A.balance) as sumOfBalance " +
                "   FROM customer C, account A, owns O " +
                "   WHERE A.aid = O.aid AND C.cid = O.cid " +
                "   GROUP BY O.cid ) as C ";


        rs = smt.executeQuery(fifthQuery);
        System.out.println("\n Give the id of the customer who has the accounts with the highest total \n");
        while (rs.next()){
//            System.out.println(" Cid: " + rs.getString("cid"));
            System.out.println(" Customer id: " + rs.getString("cid"));
//            System.out.println(" Sum is: " + rs.getString("sumOf") + "\n");
//            System.out.println(" Balance: " +  rs.getString("balance") + "\n");
//            System.out.println(" Address: " + rs.getString("address"));
//            System.out.println(" City: " + rs.getString("city") + "\n");
//            System.out.println(" Nationality: " + rs.getString("nationality") + "\n");
        }





    }

}