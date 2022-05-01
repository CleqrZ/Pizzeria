module com.sio.pizzeria {
    requires javafx.controls;
    requires javafx.fxml;

    opens com.sio.pizzeria to javafx.fxml;
    exports com.sio.pizzeria;
    requires jakarta.ws.rs;
    requires org.json;
    requires javafx.graphicsEmpty;
}
