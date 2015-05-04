import com.rabbitmq.client.ConnectionFactory;
import com.rabbitmq.client.Connection;
import com.rabbitmq.client.Channel;

public class Send {
	
  private final static String QUEUE_NAME = "hello";

  public static void main(String[] argv) throws Exception {


    System.out.println("sender gestartet");      	      
    ConnectionFactory factory = new ConnectionFactory();
    factory.setHost("localhost");
    factory.setVirtualHost("/");
    factory.setUsername("test");
    factory.setPassword("test");

    System.out.println("Credentials gesetzt");
    Connection connection = factory.newConnection();
    System.out.println("Verbindung vorbereitet");
    Channel channel = connection.createChannel();
    System.out.println("mit channel verbunden");

    channel.queueDeclare(QUEUE_NAME, false, false, false, null);
    String message = "Hello World!";
    channel.basicPublish("", QUEUE_NAME, null, message.getBytes());
    System.out.println(" [x] Sent '" + message + "'");
    
    channel.close();
    connection.close();
  }
}
