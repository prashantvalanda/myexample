package Example;

import org.junit.runner.RunWith;
import cucumber.api.CucumberOptions;
import cucumber.api.junit.Cucumber;

@RunWith(Cucumber.class)
@CucumberOptions(
		features = "Feature/LogInTest.Feature"
		,glue={"StepDefinitions"}
		)

public class TestRunner {

}