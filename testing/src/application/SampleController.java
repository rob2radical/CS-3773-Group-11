package application;

import javafx.fxml.FXML;
import javafx.scene.control.*;

public class SampleController {
	
	@FXML
	private Button testButton;
	
	@FXML
	private TextField testText;
	
	public SampleController()
	{
		
	}
	
	@FXML
	private void initialize()
	{
		
	}
	
	@FXML
	private void buttonPressed()
	{
		testText.setText("Button Pressed");
	}
}
